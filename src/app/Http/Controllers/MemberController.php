<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail; 
use App\Mail\ColocationInvite; 

class MemberController extends Controller
{
    public function invite(Request $request)
    {
        $owner = $request->user();

        if (! $owner->colocation_id || $owner->colocation_role !== 'owner') {
            abort(403);
        }

        $validated = $request->validateWithBag('invite', [
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'This email is not registered in our system.',
        ]);

        $member = User::where('email', $validated['email'])->firstOrFail();

        if ((int) $member->id === (int) $owner->id) {
            return back()->withInput()->withErrors(['email' => 'You cannot invite yourself.'], 'invite');
        }

        if ($member->colocation_id) {
            return back()->withInput()->withErrors(['email' => 'This user is already a resident in a colocation.'], 'invite');
        }

        $inviteUrl = URL::temporarySignedRoute(
            'dashboard.invitation.confirm',
            now()->addDays(1), 
            [
                'colocation' => $owner->colocation_id,
                'user' => $member->id,
            ]
        );

        try {
            $colocationName = $owner->colocation->name;
            
            Mail::send([], [], function ($message) use ($member, $colocationName, $inviteUrl) {
                $message->to($member->email)
                    ->subject("Network Access: Invitation to {$colocationName}")
                    ->html("
                        <div style='font-family: sans-serif; background: #0d0d12; color: #fff; padding: 40px; border-radius: 10px;'>
                            <h2 style='color: #a855f7;'>Encryption Link Generated</h2>
                            <p>You have been invited to join <strong>{$colocationName}</strong>.</p>
                            <p>Click the button below to initialize your residency:</p>
                            <a href='{$inviteUrl}' style='display: inline-block; background: #9333ea; color: white; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: bold; text-transform: uppercase; font-size: 12px;'>Accept Invitation</a>
                            <p style='font-size: 10px; color: #52525b; margin-top: 20px;'>Link expires in 24 hours.</p>
                        </div>
                    ");
            });

            return back()->with('status', 'Invitation successfully broadcasted to ' . $member->email);

        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['email' => 'Mail protocol failed: ' . $e->getMessage()], 'invite');
        }
    }

    public function acceptInvite(Request $request, $colocation_id, $user_id)
    {
        $user = User::findOrFail($user_id);

        if ((int) auth()->id() !== (int) $user->id) {
            abort(403, 'This invitation is not for you.');
        }

        $user->update([
            'colocation_id' => $colocation_id,
            'colocation_role' => 'member',
        ]);

        return redirect()->route('dashboard')->with('success', 'You have joined the colocation!');
    }

    public function destroy(Request $request, User $member)
    {
        $owner = $request->user();

        if (! $owner->colocation_id || $owner->colocation_role !== 'owner') {
            abort(403);
        }

        if ((int) $member->colocation_id !== (int) $owner->colocation_id) {
            abort(403);
        }
        
        if ($member->colocation_role === 'owner') {
            return back()->withErrors(['member' => 'Cannot remove owner from colocation.']);
        }
        
        $member->update(['colocation_id' => null, 'colocation_role' => null, 'reputation_score' => 0,]);
        return back()->with('status', 'Member removed.');
    }
}
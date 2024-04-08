<?php

namespace App\Http\Controllers;

use App\Models\Debate;
use App\Models\Voting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VotingController extends Controller
{
    //
    public function withUsers(Debate $debate)
    {
        $debateId = $debate->id;
        $debateExists = Debate::where('id', $debateId)->first();
        if (!$debateExists) {
            return redirect()->route('home')->with('errorResponse', 'Debate does not exist');
        }

        $votingExists = Voting::where('debate_id', $debateExists->id)->where('user_id', Auth::id())->first();
        if (!$votingExists) {
            Voting::create([
                'debate_id' => $debateExists->id,
                'user_id' => Auth::id(),
                'status' => 1,
            ]);
            $debateExists->with = $debateExists->with + 1;
            $debateExists->save();

            return redirect()->route('home')->with('successResponse', 'Supporting this Debate successfully');
        }

        if ($votingExists->status == 1) {
            $debateExists->with = $debateExists->with - 1;
            $debateExists->save();
        }else{
            $debateExists->against = $debateExists->against - 1;
            $debateExists->save();
        }

        $votingExists->delete();
        return redirect()->route('home')->with('successResponse', 'Voting removed successfully');
    }

    public function againstUsers(Debate $debate)
    {
        $debateId = $debate->id;
        $debateExists = Debate::where('id', $debateId)->first();
        if (!$debateExists) {
            return redirect()->route('home')->with('errorResponse', 'Debate does not exist');
        }

        $votingExists = Voting::where('debate_id', $debateExists->id)->where('user_id', Auth::id())->first();
        if (!$votingExists) {
            Voting::create([
                'debate_id' => $debateExists->id,
                'user_id' => Auth::id(),
                'status' => 0,
            ]);

            $debateExists->against = $debateExists->against + 1;
            $debateExists->save();

            return redirect()->route('home')->with('successResponse', 'Rejecting this Debate successfully');
        }

        if ($votingExists->status == 1) {
            $debateExists->with = $debateExists->with - 1;
            $debateExists->save();
        }else{
            $debateExists->against = $debateExists->against - 1;
            $debateExists->save();
        }

        $votingExists->delete();
        return redirect()->route('home')->with('successResponse', 'Voting removed successfully');
    }
}

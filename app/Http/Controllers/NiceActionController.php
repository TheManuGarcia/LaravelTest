<?php

namespace App\Http\Controllers;

use App\NiceActionLog;
use \Illuminate\Http\Request;
use App\NiceAction;


//Controller is a base Laravel class
class NiceActionController extends Controller
{

//Fetch all actions and pass them to our View
    public function getHome() {
        $actions = NiceAction::all();

//        Fetch all our log actions
        $logged_actions = NiceActionLog::all();

        return view('home',['actions' => $actions, 'logged_actions' => $logged_actions]);

    }

    public function getNiceAction($action, $name = null) {


        if($name === null) {
            $name = 'you';
        }

//        Identify which nice_action was executed(fetched from the DB)

        $nice_action = NiceAction::where('name', $action)->first(); #name and condition. We want the first one we find

//        Write something when our action gets executed. Create a new log entry
        $nice_action_log = new NiceActionLog();

//        Call the method we specified in our relation (NiceAction) and execute save with the argument of our log entry
        $nice_action->logged_actions()->save($nice_action_log);
//        View is in the actions folder. /actions/action.nice and give it a nice (not really using the nice name)
        return view('actions.nice', ['action' => $action, 'name' => $name]);
    }

    public function postInsertNiceAction(Request $request){

            $this->validate($request, [
//                Requires a name with alphabetical characters
                'name' => 'required|alpha|unique:nice_actions',  #Prevent from duplicating an action(from DB)
                'niceness' => 'required|numeric'
            ]);

//        Create action, give it a name, niceness is stored in the niceness field and save it
                $action = new NiceAction();
                $action->name= ucfirst(strtolower($request['name']));
                $action->niceness=$request['niceness'];
                $action->save();

//        Fetch all actions to pass them to our Home view
                $actions = NiceAction::all();
                return redirect()->route('home');
            }

    private function transformName($name){

        $prefix = 'KING ';
//        Returns KING NAME (in uppercase)
        return $prefix . strtoupper($name);
    }
}
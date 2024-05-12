<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function projectlist(){
        $projects=Project::all();
        return response()->json(['projects' => $projects]);

    }
    public function addproject(Request $request){
        $request->validate([
            'title'=> 'required',
        ]);
        $project= new Project();
        $project->title = $request->title;
        $project->save();
        return response()->json(['project added successfully']);

    }
    public function editprojectname(Request $request, $id){
        $request->validate([
            'title'=> 'required',
        ]);  
        $project = Project::find($id);   
        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }
        $project->title = $request->title;
        $project->save();
        return response()->json(['project name updated successfully']);
    }
    public function deleteproject($id){
        $project= Project::find($id);
        $project->delete();
        return response()->json(['project  deleted successfully']);

    }
    


}

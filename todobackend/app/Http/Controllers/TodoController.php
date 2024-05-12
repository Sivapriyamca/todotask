<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function todolist(){
        $todos=Todo::all();
        return response()->json(['todos' => $todos]);

    }
    public function addtodo(Request $request){
        $request->validate([
            'project_id'=> 'required',
            'description'=>'required',
            'status'=>'required'
        ]);
        $todo= new Todo();
        $todo->project_id = $request->project_id;
        $todo->description = $request->description;
        $todo->status = $request->status;
        $todo->save();
        return response()->json(['todo added successfully']);

    }
    public function updatetodo(Request $request, $id){
        $request->validate([
            'project_id'=> 'required',
            'description'=>'required',
            'status'=>'required'
        ]);  
        $todo = Todo::find($id);   
        if (!$todo) {
            return response()->json(['error' => 'Todo not found'], 404);
        }
        $todo->project_id = $request->project_id;
        $todo->description = $request->description;
        $todo->status = $request->status;
        $todo->save();
        return response()->json(['Todo updated successfully']);
    }
    public function tododelete($id){
        $todo=Todo::find($id);
        $todo->delete();
        return response()->json(['todo deleted successfully']);

    }
    public function projectwisetasks($id){

        $projectDetails = DB::table('projects')
        ->join('todos','projects.id','=','todos.project_id')
        ->select('projects.id','projects.title','todos.description','todos.status')
        ->where('todos.project_id',$id)->get();

        if ($projectDetails->isEmpty()){
            return response()->json(['error' => 'Project not found'],404);

        }
        $pendingCount =$projectDetails->where('status',0)->count();
        $completedCount =$projectDetails->where('status',1)->count();
      
        $responseData=[
            'project_id'=>$id,
            'project_title'=>$projectDetails[0]->title,
            'pending_tasks'=>$pendingCount,
            'completed_task'=>$completedCount,
            'total_task'=>$pendingCount+$completedCount,
            'tasks'=>$projectDetails
        ];
        return response()->json($responseData);


    }

}

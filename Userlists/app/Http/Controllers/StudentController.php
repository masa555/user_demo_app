<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
class StudentController extends Controller
{
   public function getIndex(Request $rq)
   {
       //キーワード受け取り
       $keyword= $rq->input('keyword');
       //クエリを生成
     $query =Student::query();
       //もしキーワードがあったら
       if(!empty($keyword))
       {
           $query->where('email','like','%'.$keyword.'%')
           ->orWhere('id','like',$keyword.'%')
           ->orWhere('name','like','%'.$keyword.'%');
           
       }
       //ページネーション
       $students =$query->
       orderBy('id','desc')
       ->paginate(7);
       return view('users.list')
       ->with('students',$students)
       ->with('keyword',$keyword);
   }
   public function new_index()
   {
      return view('student.new_index');
   }
   public function new_confirm(\App\Http\Requests\CheckStudentRequest $req)
  {
      $data = $req->all();
      return view('student.new_confirm')->with($data);
   }
   public function new_finish(Request $request)
   {
       //Studentオブジェクトの生成
      $student = new \App\Student;
       
       //値の登録
      $student->name = $request->name;
      $student->email = $request->email;
      $student->tel = $request->tel;
      
      //保存
      $student->save();
      
      //新規登録ページを表示
    return redirect()->to('/')->with('flashmessage', '登録が完了いたしました。');
       
   }
   //ユーザー情報編集
   public function edit_index(Request $request,$id)
   {
       $student=Student::findOrFail($id);
       
       return view('student.edit_index')->with('student',$student);
   }
   //確認画面
   public function edit_confirm(\App\Http\Requests\CheckStudentRequest $req)
   {
       $data=$req->all();
       
       return view('student.edit_confirm')->with($data);
   }
   //編集完了
   public function edit_finish(Request $request, $id)
   {
        $student=Student::findOrFail($id);
        
        $student->name = $request->name;
        $student->email = $request->email;
        $student->tel = $request->tel;
      
        //保存
        $student->save();
      
      return redirect()->to('/')->with('flashmessage', '更新が完了いたしました。');
   }
   //削除
   public function us_delete($id)
   {
      //削除対象レコードを検索 
      $user = Student::find($id);
      //削除
      $user->delete();
      
     return redirect()->to('/')->with('flashmessage', '削除が完了いたしました。');
   }
   public function create(Request $request)
   {
       //登録処理
       return redirect('layouts.layout')->with('message', '登録が完了しました。');
   }
}

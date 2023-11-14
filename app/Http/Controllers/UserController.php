<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use App\Models\PostComment;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\QuestionAnswerLike;
use App\Models\ContactMessage;
use App\Models\Token;
use App\Models\Payment;
use Illuminate\Http\Request;

class UserController extends Controller
{

    //  public function __construct()
    // {
    //     $this->middleware(['auth', 'verified']);
        
    // }   
   
    public function index()
    {
        $postObj = new Post();

        $posts = $postObj->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'categories.name as category_name')
            ->where('posts.status', 1)
            ->orderby('posts.id', 'desc')
            ->paginate(5);

        $recentPost = $postObj->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'categories.name as category_name')
            ->where('posts.status', 1)
            ->orderby('posts.id', 'desc')
            ->limit(3)
            ->get();

        $categories = Category::all();

        return view('user.index', compact('posts', 'categories', 'recentPost'));
       
    }

    public function sigle_post_view($id)
    {
        $postObj = new Post();

        $post = $postObj->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'categories.name as category_name')
            ->where('posts.id', $id)
            ->first();


        $commentObj = new PostComment();

        $comments = $commentObj->join('users', 'users.id', '=', 'post_comments.user_id')
            ->select('post_comments.*', 'users.name as user_name', 'users.photo as user_photo')
            ->where('post_comments.post_id', $id)
            ->orderby('post_comments.id', 'desc')
            ->paginate(3);

        return view('user.single_post_view', compact('post', 'comments'));
    }
    public function filter_by_category($id)
    {
        $postObj = new Post();

        $filtered_posts = $postObj->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'categories.name as category_name')
            ->where('posts.status', 1)
            ->where('posts.category_id', $id)
            ->orderby('posts.id', 'desc')
            ->paginate(5);

        $recentPost = $postObj->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'categories.name as category_name')
            ->where('posts.status', 1)
            ->orderby('posts.id', 'desc')
            ->limit(3)
            ->get();

        $categories = Category::all();

        return view('user.filter_by_category', compact('filtered_posts', 'categories', 'recentPost'));
    }

    public function comment_store(Request $request, $id)
    {
        $data = [
            'post_id' => $id,
            'user_id' => auth()->user()->id,
            'comment' => $request->comment,
        ];

        PostComment::create($data);

        $notify = ['message' => 'Comment Added Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notify);
    }

    public function questions()
    {
        $questionObj = new Question();
        $postObj = new Post();

        $questions = $questionObj->join('categories', 'categories.id', '=', 'questions.category_id')
            ->join('users', 'users.id', '=', 'questions.user_id')
            ->select('questions.*', 'categories.name as category_name', 'users.name as user_name', 'users.photo as user_photo')
            ->orderby('questions.id', 'desc')
            ->paginate(5);

        $recentPost = $postObj->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'categories.name as category_name')
            ->where('posts.status', 1)
            ->orderby('posts.id', 'desc')
            ->limit(3)
            ->get();

        $categories = Category::all();

        return view('user.questions', compact('questions', 'categories', 'recentPost'));
    }

    public function question_store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'question' => 'required',
        ]);

        $data = [
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'question' => $request->question,
        ];

        Question::create($data);

        $notify = ['message' => 'Question Added Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notify);
    }

    public function question_delete($id)
    {
        Question::find($id)->delete();

        $notify = ['message' => 'Question Deleted Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notify);
    }
    public function question_answers($id)
    {
        $questionObj = new Question();
        $answersObj = new QuestionAnswer();

        $question = $questionObj->join('categories', 'categories.id', '=', 'questions.category_id')
            ->join('users', 'users.id', '=', 'questions.user_id')
            ->select('questions.*', 'categories.name as category_name', 'users.name as user_name', 'users.photo as user_photo')
            ->where('questions.id', $id)
            ->first();

        $answers = $answersObj->join('users', 'users.id', '=', 'question_answers.user_id')
            ->select('question_answers.*', 'users.name as user_name', 'users.photo as user_photo')
            ->where('question_answers.question_id', $id)
            ->orderby('question_answers.id', 'desc')
            ->get();

        return view('user.question_answers', compact('question', 'answers'));
    }

    public function question_answer_store(Request $request, $id)
    {
        $data = [
            'question_id' => $id,
            'user_id' => auth()->user()->id,
            'answer' => $request->answer,
        ];

        QuestionAnswer::create($data);

        $notify = ['message' => 'Answer Added Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notify);
    }

    public function question_answer_delete($id)
    {
        QuestionAnswer::find($id)->delete();

        $notify = ['message' => 'Answer Deleted Successfully', 'alert-type' => 'success'];
        return redirect()->back()->with($notify);
    }
    public function question_answer_like($id)
    {
        $data = [
            'answer_id' => $id,
            'user_id' => auth()->user()->id
        ];

        QuestionAnswerLike::create($data);

        return redirect()->back();
    }
    public function question_answer_unlike($id)
    {
        QuestionAnswerLike::where('answer_id', $id)->where('user_id', auth()->user()->id)->delete();

        return redirect()->back();
    }

     // contact function
     public function contact()
     {
        
         return view('user.contact');
     }
     public function contact_store(Request $request)
     {
         $data = [
             'user_id' => auth()->user()->id,
             'subject' => $request->subject,
             'message' => $request->message,
         ];
 
         ContactMessage::create($data);
 
         $notify = ['message' => 'Message Sent Successfully', 'alert-type' => 'success'];
         return redirect()->back()->with($notify);
     }

       //__ about function
    public function about()
    {
        return view('user.about');
    }

public function showRechargeForm()
{
    return view('user.recharge_form');
}
//user.recharge_form

public function processRecharge(Request $request)
{
    // Get the token input from the user
    $tokenValue = $request->input('token');
    
    // Check if the token exists in the database
    $token = Token::where('value', $tokenValue)->first();
    
    if (!$token) {
        // 
        return view('user.failed_subscription');
    }
    
    // Implement your payment gateway logic here to recharge the user's account
    // Update the user's account balance accordingly

    // Create a new payment record
    $payment = new Payment();
    $payment->user_id = auth()->user()->id; // Assuming you have user authentication
    $payment->token = $tokenValue;
    $payment->amount = 1000.00; // Replace with the actual payment amount
    $payment->status = 'completed'; // Set payment status

    $payment->save();

    // Delete the used token
    $token->delete();

    $notify = ['message' => 'Subscription Successfully', 'alert-type' => 'success'];
        return redirect('/premium')->with('$notify');
}




   
 
 






}

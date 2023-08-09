<?php 
namespace Modules\Courses\src\Http\Controllers;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\Courses\src\Repositories\CoursesRepository;

class CoursesController extends Controller
{

   protected $courseRepository;
    public function __construct(CoursesRepository $courseRepository){
        $this->courseRepository = $courseRepository;
    }
    public function index(){
        $pageTitle = 'Quản lý khoá học';
        return view('courses::lists', compact('pageTitle'));
    }

        public function data(){
        $courses = $this->courseRepository->getAllCourses();
        return DataTables::of($courses)
            ->addColumn('edit', function ($course) {
                return '<a href="'.route('admin.courses.edit', $course->id).'" class="btn btn-warning">Sửa</a> ';
            })
            ->addColumn('delete', function ($course) {
                return '<a href="'.route('admin.courses.delete', $course->id).'" class="btn btn-danger delete-action">Xóa</a>';
            })
            ->editColumn('created_at', function ($course) {
                return Carbon::parse($course->created_at)->format('d/m/y H:i:s');
        })
        ->rawColumns(['edit', 'delete'])  
        ->toJson();
    }
    public function create(){
        $pageTitle = 'Thêm khóa học';
        return view('courses::add', compact('pageTitle'));
    }

    public function store(CoursesRepository $request){
    

    }

    public function edit($id){
        $course = $this->courseRepository->find($id);
        if(!$course) {
            abort(404);
        }
        $pageTitle = 'Chỉnh sửa khóa học';
        return view('courses::edit', compact('pageTitle', 'course'));
    }

    public function update(CoursesRepository $request, $id){
        // $data = $request->except('_token','password');
        // if($request->password){
        //     $data['password'] = bcrypt($request->password);
        // }
        // $this->courseRepository->update($id,$data);
        // return back()->with('msg', __('courses::messages.update.success'));
        
    }
    public function delete($id){
         $this->courseRepository->delete($id);
        return back()->with('msg', __('courses::messages.delete.success'));
    }

}
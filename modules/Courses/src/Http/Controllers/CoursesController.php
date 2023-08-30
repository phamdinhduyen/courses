<?php 
namespace Modules\Courses\src\Http\Controllers;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\Courses\src\Http\Requests\CoursesRequest;
use Modules\Courses\src\Repositories\CoursesRepository;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Modules\Teacher\src\Repositories\TeacherRepository;
class CoursesController extends Controller
{

    protected $courseRepository;
    protected $categoriesRepository;
    protected $teacherRepository;
    public function __construct(
    CoursesRepository $courseRepository, 
    CategoriesRepository $categoriesRepository,
    TeacherRepository $teacherRepository
    ){
        $this->courseRepository = $courseRepository;
        $this->categoriesRepository = $categoriesRepository;
        $this->teacherRepository = $teacherRepository;
    }
    public function index(){
        $pageTitle = 'Quản lý khoá học';
        return view('courses::lists', compact('pageTitle'));
    }

        public function data(){
        $courses = $this->courseRepository->getAllCourses();
        return DataTables::of($courses)
            ->addColumn('edit', function ($course) {
                return '<a href="' . route('admin.courses.edit', $course->id) . '" class="btn btn-warning">Sửa</a> ';
            })
            ->addColumn('delete', function ($course) {
                return '<a href="' . route('admin.courses.delete', $course->id) . '" class="btn btn-danger delete-action">Xóa</a>';
            })
            ->editColumn('created_at', function ($course) {
                return Carbon::parse($course->created_at)->format('d/m/y H:i:s');
            })
            ->editColumn('status', function ($course) {
                return $course->status == 1 ? '<button class="btn btn-success"> Kích hoạt </button>' : '<button class="btn btn-warning">Chưa kích hoạt</button>';
            })
            ->editColumn('price', function ($course) {
                if($course->price){
                    if($course->sale_price){
                        $price = number_format($course->sale_price);
                    } else {
                        $price = number_format($course->price);
                    }
                } else {
                    $price = "Miễn phí";
                }
                
                return $price;
            })
        ->rawColumns(['edit', 'delete','status'])  
        ->toJson();
    }
    public function create(){
        $pageTitle = 'Thêm khóa học';
        $categories = $this->categoriesRepository->getAllCategories();
        $teacher = $this->teacherRepository->getAllTeachers()->get();
        return view('courses::add', compact('pageTitle','categories','teacher'));
    }

    public function store(CoursesRequest $request){
        $courses = $request->except('_token');

        if(!$courses['sale_price']){
            $courses['sale_price'] = 0;
        }
        if(!$courses['price']){
            $courses['price'] = 0;
        }
        $course = $this->courseRepository->create($courses);
      
        $categories = $this->getCategories($courses);
        $this->courseRepository->createCourseCategories($course, $categories);
        return redirect()->route('admin.courses.index')->with('msg', __('courses::messages.create.success'));

    }

    public function edit($id){
        $course = $this->courseRepository->find($id);
        $categoryId = $this->courseRepository->getRelatedCategories($course);
        $teacher = $this->teacherRepository->getAllTeachers()->get();
        $categories = $this->categoriesRepository->getAllCategories();
        if(!$course) {
            abort(404);
        }
        $pageTitle = 'Chỉnh sửa khóa học';
        return view('courses::edit', compact('pageTitle', 'course','categories','categoryId','teacher'));
    }

    public function update(CoursesRequest $request, $id){
        $courses = $request->except('_token','_PUT');
        if(!$courses['sale_price']){
            $courses['sale_price'] = 0;
        }
        if(!$courses['price']){
            $courses['price'] = 0;
        }
        $this->courseRepository->update($id,$courses);
        $categories = $this->getCategories($courses);
        $course = $this->courseRepository->find($id);
        $this->courseRepository->updatedCourseCategories($course, $categories);
        return back()->with('msg', __('courses::messages.update.success'));
        
    }
    public function delete($id){
        $course = $this->courseRepository->delete($id);
        $status = $this->courseRepository->delete($id);
        if ($status) {
            $image = $course->thumbnail;
            deleteFileStorage($image);   
        }
        return back()->with('msg', __('courses::messages.delete.success'));
    }

    public function getCategories($courses){
      $categories = [];
        foreach($courses['categories'] as $category){
            $categories[$category] = ['created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')];
        }
        return $categories;
    }

}
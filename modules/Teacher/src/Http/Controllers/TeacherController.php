<?php 
namespace Modules\Teacher\src\Http\Controllers;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\Teacher\src\Http\Requests\TeacherRequest;
use Modules\Teacher\src\Repositories\TeacherRepository;

class TeacherController extends Controller
{
    protected $teacherRepository;
    public function __construct(TeacherRepository $teacherRepository){
        $this->teacherRepository = $teacherRepository;
    }
    public function index(){
        $pageTitle = 'Quản lý giảng viên';
        return view('teacher::lists', compact('pageTitle'));
    }

        public function data(){
        $teachers = $this->teacherRepository->getAllTeachers();
        return DataTables::of($teachers)
            ->addColumn('edit', function ($teacher) {
                return '<a href="' . route('admin.teachers.edit', $teacher->id) . '" class="btn btn-warning">Sửa</a> ';
            })
            ->addColumn('delete', function ($teacher) {
                return '<a href="' . route('admin.teachers.delete', $teacher->id) . '" class="btn btn-danger delete-action">Xóa</a>';
            })
            ->editColumn('created_at', function ($teacher) {
                return Carbon::parse($teacher->created_at)->format('d/m/y H:i:s');
            })
            ->addColumn('image', function ($teacher) {
                return $teacher->image ? '<img src="' . $teacher->image . '" style="width: 50px; height:50px; border-radius:50%; border:1px solid black; margin:auto"> ' : "";
            })
        ->rawColumns(['edit', 'delete', 'image'])  
        ->toJson();
    }
    public function create(){
        $pageTitle = 'Thêm giảng viên';
        return view('teacher::add', compact('pageTitle'));
    }

    public function store(TeacherRequest $request){
        $this->teacherRepository->create([
            'name' => $request->name,
            'image' => $request->image,
            'epx' => $request->epx,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);
        return redirect()->route('admin.teachers.index')->with('msg', __('teacher::messages.create.success'));
    }

    public function edit($id){
        $teacher = $this->teacherRepository->find($id);
        if(!$teacher) {
            abort(404);
        }
        $pageTitle = 'Chỉnh sửa giảng viên';
        return view('teacher::edit', compact('pageTitle', 'teacher'));
    }

    public function update(TeacherRequest $request, $id){
        $data = $request->except('_token');
        $this->teacherRepository->update($id,$data);
        return back()->with('msg', __('teacher::messages.update.success'));
        
    }
    public function delete($id){
        $teacher = $this->teacherRepository->find($id);
        $status = $this->teacherRepository->delete($id);
        if ($status) {
            $image = $teacher->image;
            deleteFileStorage($image);   
        }
        return back()->with('msg', __('teacher::messages.delete.success'));
    }

}
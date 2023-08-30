<?php
namespace Modules\Courses\src\Repositories;
use App\Repositories\BaseRepository;
use Modules\Courses\src\Models\Course;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;

class CoursesRepository extends BaseRepository implements CoursesRepositoryInterface
{
    public function getModel()
    {
    return Course::class;
    }

    public function getCourse($limit){
        return $this->model->paginate($limit);
    }
    public function getAllCourses(){
        return $this->model->select(['id','name','price','sale_price','status','created_at'])->latest();
    }

    public function createCourseCategories($course, $data = []){
        $course->categories()->attach($data);
    }

    public function updatedCourseCategories($course, $data = []){
        $course->categories()->sync($data);
    }
    public function deleteCourseCategories($course){
        $course->categories()->detach();
    }
      
    public function getRelatedCategories($course){
        $categoryId = $course->categories()->allRelatedIds()->toArray();
        return $categoryId;
    }
}
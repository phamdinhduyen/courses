<?php
namespace Modules\Courses\src\Repositories;
use App\Repositories\BaseRepository;
use Modules\Courses\src\Models\Courses;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;

class CoursesRepository extends BaseRepository implements CoursesRepositoryInterface
{
    public function getModel()
    {
    return Courses::class;
    }

    public function getCourse($limit){
        return $this->model->paginate($limit);
    }
    public function getAllCourses(){
        return $this->model->select(['id','name','price','status','created_at'])->latest();

    }
}
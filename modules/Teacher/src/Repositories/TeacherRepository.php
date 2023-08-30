<?php
namespace Modules\Teacher\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Teacher\src\Models\Teacher;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;

class TeacherRepository extends BaseRepository implements TeacherRepositoryInterface
{
    public function getModel()
    {
        return Teacher::class;
    }

    public function getTeacher($limit)
    {
        return $this->model->paginate($limit);
    }
    public function getAllTeachers()
    {
        return $this->model->select(['id', 'name', 'image', 'description', 'epx', 'created_at'])->latest();
    }
}
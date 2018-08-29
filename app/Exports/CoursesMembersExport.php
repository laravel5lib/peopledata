<?php

namespace App\Exports;

use App\PCO\Course;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CoursesMembersExport implements FromView, Responsable, ShouldAutoSize
{
    use Exportable;

    protected $period;
    private $fileName = 'courses_members.xlsx';

    public function __construct($period)
    {
        $this->period   = $period;
        $this->fileName = $period . '-' . $this->fileName;
    }

    public function view() : View
    {
        $days = ['1' => 'Lunes', '2' => 'Martes', '3' => 'Miércoles', '4' => 'Jueves', '5' => 'Viernes', '6' => 'Sábado', '0' => 'Domingo'];
        $options = [
            'signed'=>'Pre-inscrito',
            'confirmed'=>'Confirmado',
            'in_progress'=>'En curso',
            'completed'=>'Completado',
            'didnt_start'=>'No llegó',
            'didnt_finish'=>'Desertó',
            ];
        $courses = Course::where('period', $this->period)->with('members')->get();
        return view('courses.export', compact('days', 'courses', 'options'));
    }
}

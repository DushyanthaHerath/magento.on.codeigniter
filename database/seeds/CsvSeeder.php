<?php

use Illuminate\Database\Seeder;

class CsvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = storage_path('app/public/students_records.csv');
        $row = 1;
        if (($handle = fopen($filename, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1001, ",")) !== FALSE) {
                $num = count($data);                
                if($row>1) {
                    // Find or Create Teacher
                    $teacherId = 0;
                    if(App\Models\Teacher::where('name', $data[0])->count()>0) {
                        $teacher = App\Models\Teacher::where('name', $data[0])->first();
                        $teacherId = $teacher->id;
                    } else {                        
                        $teacher = new App\Models\Teacher;
                        $teacher->name = $data[0];
                        $teacher->save();
                        $teacherId = $teacher->id;
                    }                        
                    // Find or Create Class
                    $classRoomId = 0;
                    if(App\Models\ClassRoom::where('name', $data[1])->count()>0) {
                        $classRoom = App\Models\ClassRoom::where('name', $data[1])->first();
                        $classRoomId = $classRoom->id;
                    } else {
                        $classRoom = new App\Models\ClassRoom;
                        $classRoom->name = $data[1];
                        $classRoom->save();
                        $classRoomId = $classRoom->id;
                    }
                    
                    $student = new App\Models\Student;
                    $student->firstname = $data[2];
                    $student->lastname = $data[3];
                    $student->gender = $data[4];
                    $student->joined_year = $data[5];
                    $student->class_room_id = $classRoomId;
                    $student->teacher_id = $teacherId;
                    $student->save();
                }                
                $row++;
            }
            fclose($handle);
        }
    }
}

SELECT 
        s.first_name AS "Student Name",
        s.last_name AS "Last Name",
        c.class_name as "Class Name",
        d.department_name AS "Department"
    
    FROM 
        Students s
    JOIN 
        Departments d 
    ON 
        s.department_id = d.department_id
          JOIN  class c ON  c.class_id = s.class_id
    
    WHERE  
     s.password = 123  AND
        s.student_code = 'HR0001';
        


       #........... marks
             SELECT   SUM(total_marks) as Total  from exam_results er JOIN 
        semester_subject sub ON er.subject_id = sub.subject_id
       JOIN  students s ON   s.student_id = er.student_id
    WHERE 
        s.student_code = 'HR0001'
        AND sub.semester_id = 5;
        
        SELECT SUM(ex_r.total_marks)/COUNT(ex_r.subject_id) AS percentage 
                        FROM exam_results ex_r  
                        LEFT JOIN semester_subject sub ON ex_r.subject_id = sub.subject_id 
                        LEFT JOIN students s ON s.student_id = ex_r.student_id 
                        WHERE s.student_code = 'HR0001' AND sub.semester_id = 5



                         SELECT 
        sub.subject_name AS "Subject Name",
        CONCAT(COALESCE(er.midterm, 0), ' (30)') AS "Midterm",
        CONCAT(COALESCE(er.coursework, 0), ' (10)') AS "CourseWork",
        CONCAT(COALESCE(er.final, 0), ' (60)') AS "Final",
        CONCAT(COALESCE(er.reexam, 0), ' (69)') AS "ReExam",
        (COALESCE(er.midterm, 0) + 
         COALESCE(er.coursework, 0) + 
         COALESCE(er.final, 0) + 
         COALESCE(er.reexam, 0)) AS "Total",
        CASE 
            WHEN (COALESCE(er.midterm, 0) + 
                  COALESCE(er.coursework, 0) + 
                  COALESCE(er.final, 0) + 
                  COALESCE(er.reexam, 0)) >= 90 THEN 'A+'
            WHEN (COALESCE(er.midterm, 0) + 
                  COALESCE(er.coursework, 0) + 
                  COALESCE(er.final, 0) + 
                  COALESCE(er.reexam, 0)) >= 80 THEN 'B'
            WHEN (COALESCE(er.midterm, 0) + 
                  COALESCE(er.coursework, 0) + 
                  COALESCE(er.final, 0) + 
                  COALESCE(er.reexam, 0)) >= 70 THEN 'C'
            WHEN (COALESCE(er.midterm, 0) + 
                  COALESCE(er.coursework, 0) + 
                  COALESCE(er.final, 0) + 
                  COALESCE(er.reexam, 0)) >= 60 THEN 'D'
            WHEN (COALESCE(er.midterm, 0) + 
                  COALESCE(er.coursework, 0) + 
                  COALESCE(er.final, 0) + 
                  COALESCE(er.reexam, 0)) >= 50 THEN 'E'
            ELSE 'F'
        END AS "Grade"
    FROM 
        Exam_Results er
    JOIN 
        Subjects sub ON er.subject_id = sub.subject_id
       JOIN  students s ON   s.student_id = er.student_id
    WHERE 
        s.student_code = studentCode 
        AND s.password = _password 
           
        
    ORDER BY 
         sub.subject_name;
                        
                          
        
        
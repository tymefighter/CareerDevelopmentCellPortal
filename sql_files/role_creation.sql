-- File To Create Roles

-- student vol
create role student_vol;
-- grant select on academic_performance to tpo;
grant select on apply_internship to student_vol;
grant select on apply_job to student_vol;
grant select on batch to student_vol;
grant select on belongs_to to student_vol;
grant select on branch to student_vol;
grant select on cgpa to student_vol;
grant select on company to student_vol;
grant select on company_internship to student_vol;
grant select on company_job to student_vol;
grant select on course to student_vol;
grant select on eligible_branch_job to student_vol;
grant select on eligible_batch_internship to student_vol;
grant select on has_branch to student_vol;
grant select on internship to student_vol;
grant select on job to student_vol;
grant select on num_sem_completed to student_vol;
grant select on placed_internship to student_vol;
grant select on placed_job to student_vol;
grant select on required_branch_internship to student_vol;
grant select on required_course_internship to student_vol;
grant select on required_course_job to student_vol;
grant select on student to student_vol;
grant select on student_info to student_vol;
grant select on student_performance to student_vol;
grant select on taken to student_vol;

-- cdc officials

create role cdc_official;
grant select on academic_performance to cdc_official;
grant select on apply_internship to cdc_official;
grant select on apply_job to cdc_official;
grant select on batch to cdc_official;
grant select on belongs_to to cdc_official;
grant select on branch to cdc_official;
grant select on cgpa to cdc_official;
grant select on company to cdc_official;
grant select on company_internship to cdc_official;
grant select on company_job to cdc_official;
grant select on course to cdc_official;
grant select on eligible_branch_job to cdc_official;
grant select on eligible_batch_internship to cdc_official;
grant select on has_branch to cdc_official;
grant select on internship to cdc_official;
grant select on job to cdc_official;
grant select on num_sem_completed to cdc_official;
grant select on placed_internship to cdc_official;
grant select on placed_job to cdc_official;
grant select on required_branch_internship to cdc_official;
grant select on required_course_internship to cdc_official;
grant select on required_course_job to cdc_official;
grant select on student to cdc_official;
grant select on student_info to cdc_official;
grant select on student_performance to cdc_official;
grant select on taken to cdc_official;
grant select on student_vol to cdc_official;
grant select on student_vol_info to cdc_official;


-- TPO (tpo is also a cdc official, but a higher privileged one)
create role tpo;
grant all on student_vol to tpo with grant option;
grant select on academic_performance to tpo;
grant select on apply_internship to tpo;
grant select on apply_job to tpo;
grant select on batch to tpo;
grant select on belongs_to to tpo;
grant select on branch to tpo;
grant select on cgpa to tpo;
grant select, insert, update, delete on company to tpo;
grant select on company_internship to tpo;
grant select on company_job to tpo;
grant select on course to tpo;
grant select on eligible_branch_job to tpo;
grant select on eligible_batch_internship to tpo;
grant select on has_branch to tpo;
grant select on internship to tpo;
grant select on job to tpo;
grant select on num_sem_completed to tpo;
grant select on placed_internship to tpo;
grant select on placed_job to tpo;
grant select on required_branch_internship to tpo;
grant select on required_course_internship to tpo;
grant select on required_course_job to tpo;
grant select on student to tpo;
grant select on student_info to tpo;
grant select on student_performance to tpo;
grant select on taken to tpo;
grant select on student_vol to tpo;
grant select on student_vol_info to tpo;

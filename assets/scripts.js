$(function () {

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    $('.timepicker').datetimepicker({
        datepicker: false,
        format: 'H:i'
    });
    $('.datepicker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
    });

    var site_url = 'http://localhost/examcell/';
    console.log("opening");

    $("#student_form").validate({
        rules: {
            regno: {required:true},
            email: {required:true, email:true},
            firstname: {required: true},
            lastname: {required: true},
            student_department: {required: true},
            student_batch: {required: true},
            phonenumber: {required: true, minlength:10, maxlength:10, digits:true}
        }
    });
    
    $("#staff_form").validate({
        rules: {
            email: {required:true, email:true},
            firstname: {required: true},
            lastname: {required: true},
            staff_department: {required: true},
            phonenumber: {required: true, minlength:10, maxlength:10, digits:true}
        }
    });
    
    $("#batch_master_form").validate({
        rules: {
            dept: {required: true},
            batchyear: {required: true}
        }
    });
    
    $("#block_master_form").validate({
        rules: {
            dept: {required: true},
            block: {required: true}
        }
    });
    
    $("#room_master_form").validate({
        rules: {
            room: {required: true},
            dept: {required: true},
            block: {required: true},
            capacity: {required: true, digits: true},
            row_dim: {required: true, digits: true},
            col_dim: {required: true, digits: true},

        }
    });
    
    $("#department_master_form").validate({
        rules: {
            deptname: {required: true},
            deptslug: {required: true}
        }
    });
    
    $("#department_master_form").validate({
        rules: {
            deptname: {required: true},
            deptslug: {required: true}
        }
    });

    $("#exam_form").validate({
        rules: {
            exam_name: {required: true},
            exam_subject_name: {required: true},
            exam_subject_code: {required: true},
            exam_date: {required: true},
            exam_start_time: {required: true},
            exam_end_time: {required: true},
            exam_end_time: {required: true},
        }
    });

    $("body").on('click', '.filter-table', function() {
        var dept = $('select[name=student_department]').val();
        var batch = $('select[name=student_batch]').val();

        if (dept != 0 || batch != 0) {
            window.location = site_url + 'admin/student.php?dept=' + dept + '&batch=' + batch;
        } else {
            window.location = site_url + 'admin/student.php';
        }

    });

    $("body").on('change', 'input[name=deptname]', function () {
        var dept_slug = $('#deptname').val();
        dept_slug = dept_slug.split(" ").join("-").toLowerCase();

        $('#deptslug').val(dept_slug);
    });

    // When department in room page changes
    $("body").on('change', 'select[name=dept]', function () {
        var deptid = $('select[name=dept]').val();

        $('select[name=block] option:not(:first)').remove();

        $.ajax({
            type: 'POST',
            url: 'controller.php',
            data: {
                "get_dept_blocks": true,
                "deptid": deptid
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.success) {
                    var blocks = data.blocks;
                    var options = ``;
                    console.log(blocks);
                    for (i = 0; i < blocks.length; i++) {
                        options += `<option value='` + blocks[i]['blockid'] + `'>` + blocks[i]['blockname'] + `</option>`;
                    }
                    $('select[name=block]').append(options);
                } else {
                    console.log("wrong");
                }
            },
            error: function () {
                console.log("Error");
            }
        });
    });

    // When department in exam page changes
    $("body").on('change', 'select[name=exam_dept]', function () {
        var deptid = $('select[name=exam_dept]').val();
        console.log(deptid);

        $('select[name=exam_batch] option:not(:first)').remove();

        $.ajax({
            type: 'POST',
            url: 'controller.php',
            data: {
                "get_department_batches": true,
                "deptid": deptid
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.success) {
                    console.log(data);
                    var batches = data.batches;
                    var options = ``;
                    console.log(batches);
                    for (i = 0; i < batches.length; i++) {
                        options += `<option value='` + batches[i]['batchid'] + `'>` + batches[i]['batchyear'] + `</option>`;
                    }
                    $('select[name=exam_batch]').append(options);
                } else {
                    console.log("wrong");
                }
            },
            error: function () {
                console.log("Error");
            }
        });
    });

    // When department in exam page changes
    $("body").on('change', 'select[name=exam_batch]', function () {
        var deptid = $('select[name=exam_dept]').val();
        console.log(deptid);
        var batchid = $('select[name=exam_batch]').val();
        console.log(batchid);

        // $('select[name=exam_batch] option:not(:first)').remove();

        // $.ajax({
        //     type: 'POST',
        //     url: 'controller.php',
        //     data: {
        //         "get_exam_capacity": true,
        //         "deptid": deptid,
        //         "batchid": batchid
        //     },
        //     success: function (data) {
        //         data = JSON.parse(data);
        //         if (data.success) {
        //             console.log(data);
        //             $('input[name=exam_capacity]').val(data.student_capacity);
        //         } else {
        //             console.log("wrong");
        //         }
        //     },
        //     error: function () {
        //         console.log("Error");
        //     }
        // });
    });

    $("body").on('click', '.validate_rooms', function () {
        var that = $(this);
        var form = that.parents('form.validate_rooms');

        if (form.validate()) {
            var row_dim = form.find('input[name="row_dim"]').val()
            var col_dim = form.find('input[name="col_dim"]').val()
            var capacity = form.find('input[name="capacity"]').val()

            if (row_dim * col_dim >= capacity) {
                form.submit();
            } else {
                alert("Room Dimension is not correct");
                return false;
            }
        }
        // form.submit();
    });

    // When department in student page changes
    $("body").on('change', 'select[name=student_department]', function () {
        var deptid = $('select[name=student_department]').val();
        console.log(deptid);

        $('select[name=student_batch] option:not(:first)').remove();

        $.ajax({
            type: 'POST',
            url: 'controller.php',
            data: {
                "get_department_batches": true,
                "deptid": deptid
            },
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                if (data.success) {
                    var batches = data.batches;
                    var options = ``;
                    console.log(batches);
                    for (i = 0; i < batches.length; i++) {
                        options += `<option value='` + batches[i]['batchid'] + `'>` + batches[i]['batchyear'] + `</option>`;
                    }
                    $('select[name=student_batch]').append(options);
                } else {
                    console.log("wrong");
                }
            },
            error: function () {
                console.log("Error");
            }
        });

    });

    $("body").on('change', '.hall_management input[name=exam_date]', function () {
        $('button[type=submit]').attr('disabled', 'disabled');

        var exam_date = $('input[name=exam_date]').val();
        $('.exam_details').empty();
        console.log(exam_date);

        console.log($('.exam_details').children().length);
        // $('select[name=exam_batch] option:not(:first)').remove();
        // $('input[name=exam_capacity]').val(0);

        $.ajax({
            type: 'POST',
            url: 'controller.php',
            data: {
                "get_exam_based_on_dates": true,
                "exam_date": exam_date
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.success) {
                    console.log(data);
                    var details = data.exams;

                    if (details.length == 0) {
                        $('.exam_details').append('<div class="alert alert-danger fade show text-center" role="alert">No Exams Found!</div>');
                    }

                    var detail = ``;

                    for (var i = 0; i < details.length; i++) {
                        console.log(details[i].exam_id);

                        detail += `
                        <div class='mb-3 form-check'>
                            <input type='checkbox' class='form-check-input' data-start_time='`+details[i].exam_start_time+`' data-end_time='`+details[i].exam_end_time+`' data-capacity='` + details[i].exam_capacity + `' name='exam_details[]' id='exam_detail_` + details[i].exam_id + `' value='` + details[i].exam_id + `'>
                            <label class='form-check-label' for='exam_detail_` + details[i].exam_id + `'>
                                ` + details[i].exam_name + ` - ` + details[i].exam_subject_code + ` ` + details[i].exam_subject_name + `<br>
                                ` + details[i].exam_deptname + ` ` + details[i].exam_batch + `<br>
                                ` + details[i].exam_start_time + ` to ` + details[i].exam_end_time + `<br>
                                ` + `<b>(Capacity : ` + details[i].exam_capacity + `)</b>
                            </label>
                        </div>
                        `;
                    }

                    if ($('.exam_details').children().length == 0) {
                        $('.exam_details').append(detail);
                    }

                } else {
                    console.log("wrong");
                }
            },
            error: function () {
                console.log("Error");
            }
        });
    });

    // $("body").on('click', '.filter_halls', function () {
    $("body").on('change', 'input[name="exam_details[]"]', function () {
        console.log("filter halls");
        $('button[type=submit]').attr('disabled', 'disabled');
        $('.hall_details').empty();

        var exam_date = $('input[name=exam_date]').val();

        if ($('input[name="exam_details[]"]:checked').length > 0) {
            console.log("coes");

            var exam_capacity = 0;
            var checked_exams = $('input[name="exam_details[]"]:checked');
            var start_times = [];
            var end_times = [];

            for (var i = 0; i < checked_exams.length; i++) {
                exam_id = $(checked_exams[i]).val();
                capacity = $(checked_exams[i]).data('capacity');
                console.log(exam_id);
                console.log(capacity);
                exam_capacity = exam_capacity + capacity;

                start_time = new Date(exam_date + ' ' + $(checked_exams[i]).data('start_time'));
                end_time = new Date(exam_date + ' ' + $(checked_exams[i]).data('end_time'));
                start_times.push(start_time);
                end_times.push(end_time);
            }

            // start_times.push(new Date('2023-01-18 08:00'));
            // end_times.push(new Date('2023-01-18 11:00'))

            var min = start_times.reduce(function (a, b) { return a < b ? a : b; });
            var max = end_times.reduce(function (a, b) { return a > b ? a : b; });

            var min_time = padTo2Digits(min.getHours()) + ':' + padTo2Digits(min.getMinutes());
            var max_time = padTo2Digits(max.getHours()) + ':' + padTo2Digits(max.getMinutes());

            $('.seats_needed').text(exam_capacity);
            $('.seats_allotted').text(0);

            $('input[name=start_time]').val(min_time);
            $('input[name=end_time]').val(max_time);

            $.ajax({
                type: 'POST',
                url: 'controller.php',
                data: {
                    "get_avail_halls": true,
                    "exam_date": exam_date,
                    "min_time" : min_time,
                    "max_time" : max_time
                },
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.success) {
                        console.log(data);
                        var halls = data.halls;

                        var hall = ``;

                        for (var i = 0; i < halls.length; i++) {
                            console.log(halls[i].roomid);

                            hall += `
                            <div class='mb-3 form-check'>
                                <input type='checkbox' class='form-check-input' name='exam_halls[]' data-capacity='`+halls[i].roomcapacity+`' id='exam_hall_` + halls[i].roomid + `' value='` + halls[i].roomid + `'>
                                <label class='form-check-label' for='exam_hall_` + halls[i].roomid + `'>
                                    ` + halls[i].deptname + ` - ` + halls[i].blockname + ` Block` + `<br>
                                    ` + `<b>Room : ` + halls[i].roomname + `</b><br>
                                    ` + `<b>(Capacity : ` + halls[i].roomcapacity + `)</b>
                                </label>
                            </div>
                            `;
                        }

                        if ($('.hall_details').children().length == 0) {
                            $('.hall_details').append(hall);
                        }

                    } else {
                        console.log("wrong");
                    }
                },
                error: function () {
                    console.log("Error");
                }
            });
        } else {
            alert('Please select atleast one exam');
        }
    });

    $("body").on('change', 'input[name="exam_halls[]"]', function () {
        console.log("change allocations");

        var needed = $('.seats_needed').text();
        var exam_capacity = 0;
        var checked_halls = $('input[name="exam_halls[]"]:checked');

        for (var i = 0; i < checked_halls.length; i++) {
            roomid = $(checked_halls[i]).val();
            capacity = $(checked_halls[i]).data('capacity');
            console.log(roomid);
            exam_capacity = exam_capacity + capacity;
        }

        needed = needed - exam_capacity;

        $('.seats_allotted').text(exam_capacity);

        if (parseInt($('.seats_needed').text()) <= parseInt($('.seats_allotted').text())) {
            console.log("matched");
            $('.seats_allotted').text(parseInt($('.seats_needed').text()));
            $('input[name="exam_halls[]"]:not(:checked)').attr('disabled', 'disabled');
            $('button[type=submit]').removeAttr('disabled');
        } else {
            $('button[type=submit]').attr('disabled', 'disabled');
            $('input[name="exam_halls[]"]:disabled').removeAttr('disabled');
        }
    });

    $('.show_exam_detail').on('click', function () {
        $('#show_exam_detail .modal-content').empty();
        var hall_id = $(this).data('hall_id');

        $.ajax({
            type: 'POST',
            url: 'controller.php',
            data: {
                "get_hall_data": true,
                "id": hall_id
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.success) {
                    var halls = data.halls;
                    var exams = halls[0].exams;
                    var html = ``;

                    html += `
                    <div class="modal-header">
                        <h5 class="modal-title"> Hall : `+halls[0].block + ` Block - ` + halls[0].room + ` Room</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                    `;

                    html += `<span class="badge bg-secondary"><i class="fa fa-calendar" aria-hidden="true"></i> `+halls[0].date + ` (` + halls[0].start_time + ` to ` + halls[0].end_time +`)</span><br>`;
                    html += `<div class="accordion accordion-flush" id="exam_detial_accordion">`;

                    for (var i=0; i<exams.length; i++) {
                        html += `<div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#exam_details_`+exams[i].exam_id+`" aria-expanded="false" aria-controls="exam_details_`+exams[i].exam_id+`">
                            <b>` + exams[i].deptname + ` ` + exams[i].batchyear + `</b>&nbsp;&nbsp;(` + exams[i].exam_start_time + ` to ` + exams[i].exam_end_time + `)` + `
                            </button>
                        </h2>
                        <div id="exam_details_`+exams[i].exam_id+`" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#exam_detial_accordion">
                            <div class="accordion-body text-start">
                                Exam Name : ` + exams[i].exam_name + `<br>
                                Subject Name : ` + exams[i].exam_subject_name + `<br>
                                Subject Code : ` + exams[i].exam_subject_code + `<br>
                            </div>
                        </div>
                        </div>`;
                    }
                    html += `</div>`;
                    html += `</div>`;
                    $('#show_exam_detail .modal-content').append(html);
                } else {
                    console.log("wrong");
                }
            },
            error: function () {
                console.log("Error");
            }
        });

        var examViewModal = new bootstrap.Modal(document.getElementById('show_exam_detail'), {
            keyboard: false
        });

        examViewModal.toggle();
    });

    $('.assign_invigilator').on('click', function () {
        $('#assign_invigilator .modal-content').empty();
        var hall_id = $(this).data('hall_id');

        $.ajax({
            type: 'POST',
            url: 'controller.php',
            data: {
                "get_invigilators": true,
                "id": hall_id
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.success) {
                    console.log(data);
                    var staffs = data.staffs;
                    var html = ``;

                    html += `
                    <div class="modal-header">
                        <h5 class="modal-title">Assign Invigilator</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="controller.php" id="assignInvigilatorForm" name="assign_staff_form" role="form" method="POST">
                    <input name="hall_id" id="hall_id" value="` + hall_id + `" class="visually-hidden">
                    <div class="modal-body text-center">
                    `;

                    html +=  `<select class="form-select" name="assign_staff" id="assign_staff" aria-label="Default select example" required>`
                    html += `<option selected>Select Staff</option>`;
                    for (var i=0; i<staffs.length; i++) {
                        html += `<option value="`+staffs[i].staff_id+`">`+staffs[i].firstname + ` ` + staffs[i].lastname+` <small>(` + staffs[i].deptname + `)</small></option>`;
                    }
                    html +=  `</select>`
                    html += `</div>`;

                    html += `
                    <div class="modal-footer">					
					    <input type="submit" name="assign_invigilator" class="btn btn-primary btn-sm" id="submit">
				    </div>
                    </form>`;

                    $('#assign_invigilator .modal-content').append(html);
                } else {
                    console.log("wrong");
                }
            },
            error: function () {
                console.log("Error");
            }
        });

        var assignStaffModel = new bootstrap.Modal(document.getElementById('assign_invigilator'), {
            keyboard: false
        });
        assignStaffModel.toggle();
    });

    $("#assignInvigilatorForm").submit(function(event){
        $("#assign_invigilator").modal('hide');
        // submit_assign_staff_form();
        return false;
    });

    $("body").on('change', 'input[name=exam_report_date]', function () {
        var exam_report_date = $(this).val();
        $.ajax({
            type: "POST",
            url: "controller.php",
            data: {
                "get_dept_based_exams": true,
                "exam_report_date": exam_report_date 
            },
            cache: false,
            success: function (data) {
                data = JSON.parse(data);
                if (data.success) {

                    $('button[name=exam_report_download]').attr('disabled', 'disabled');
                    $('select[name=exam_report_dept] option:not(:first)').remove();

                    var departments = data.departments;

                    if (departments.length == 0) {
                        $('select[name=exam_report_dept] option:not(:first)').remove();
                    }

                    var options = ``;

                    for (i = 0; i < departments.length; i++) {
                        options += `<option value='` + departments[i][0] + `'>` + departments[i][1] + `</option>`;
                    }
                    $('select[name=exam_report_dept]').append(options);
                }
            },
            error: function () {
                alert("Error");
            }
        });

    });

    $("body").on('change', 'select[name=exam_report_dept]', function () {
        var exam_report_dept = $(this).val()
        if (exam_report_dept!=0) {
            $('button[name=exam_report_download]').removeAttr('disabled');
        } else {
            $('button[name=exam_report_download]').attr('disabled', 'disabled');
        }
    });
});

function submit_assign_staff_form(){
    var form_data = $('form#assignInvigilatorForm').serialize();
    $.ajax({
        type: "POST",
        url: "controller.php",
        data: {
            "assign_staff_invigilator": true,
            "form_data": form_data
        },
        cache:false,
        success: function (data) {
            data = JSON.parse(data);
            if (data.success) {
                console.log(data);
                // $("#contact").html(response)
                $("#assign_invigilator").modal('hide');
            }
        },
        error: function(){
            alert("Error");
        }
    });
}

function unique(list) {
    var result = [];
    $.each(list, function(i, e) {
        if ($.inArray(e, result) == -1) result.push(e);
    });
    return result;
}

function padTo2Digits(num) {
    return String(num).padStart(2, '0');
}

function run_cron_manual() {
    $('#run_cron_manual').attr('disabled', 'disabled');
    $.ajax({
        type: 'GET',
        url: 'cron_job.php',
        success: function (data) {
            $('#run_cron_manual').removeAttr('disabled');
        },
        error: function(){
            alert('Could not run cron manually');
        }
    });
}
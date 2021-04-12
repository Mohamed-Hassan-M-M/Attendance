$(function() {
    $form = $("#form");
    $cities = $("#cities");
    $areas = $("#areas");
    $governorates = $("#governorates");
    $schools = $("#schools");
    $grades = $("#grades");
    $classes = $("#classes");
    $form.length && $form.validate();

    $cities.change(function(e) {
        e.preventDefault();

        $areas.empty();
        $areas.prop("disabled", true);
        $areas.append('<option selected value="">Choose Area</option>');

        var city_id = $cities.val();
        if (city_id) {
            $.ajax({
                url: APP_URL + "/api/city/" + city_id,
                type: "get",
                success: function(data) {
                    if (data.status == 1) {
                        $areas.empty();
                        $areas.prop("disabled", false);

                        $areas.append(
                            '<option selected value="">Choose Area</option>'
                        );
                        $.each(data.data, function(index, area) {
                            $areas.append(
                                '<option value="' +
                                    area.id +
                                    '">' +
                                    area.name +
                                    "</option>"
                            );
                        });
                    }
                },
                error: function(jqXhr, textStatus, errorMessage) {
                    alert(errorMessage);
                }
            });
        } else {
            $areas.empty();
            $areas.append('<option value="">Choose Area</option>');
        }
    });
    $governorates.change(function(e) {
        e.preventDefault();

        $cities.empty();
        $cities.prop("disabled", true);
        $cities.append('<option selected value="">Choose City</option>');
        $areas.empty();
        $areas.prop("disabled", true);
        $areas.append('<option selected value="">Choose Area</option>');
        var governorate_id = $governorates.val();
        if (governorate_id) {
            $.ajax({
                type: "get",
                url: APP_URL + "/api/governorate/" + governorate_id,
                success: function(data) {
                    if (data.status == 1) {
                        $cities.empty();
                        $cities.prop("disabled", false);

                        $cities.append(
                            '<option selected value="">Choose City</option>'
                        );
                        $.each(data.data, function(index, city) {
                            $cities.append(
                                '<option value="' +
                                    city.id +
                                    '">' +
                                    city.name +
                                    "</option>"
                            );
                        });
                    }
                },
                error: function(jqXhr, textStatus, errorMessage) {
                    alert(errorMessage);
                }
            });
        } else {
            $cities.empty();
            $cities.append('<option value="">Choose City</option>');
        }
    });
    $schools.change(function(e) {
        e.preventDefault();

        var school_id = $schools.val();
        if (school_id) {
            $.ajax({
                url: APP_URL + "/api/grade/" + school_id,
                type: "get",
                success: function(data) {
                    if (data.status == 1) {
                        $("#grades,#single-grade").empty();
                        $("#grades,#single-grade").append(
                            '<option selected value="">Choose Grade</option>'
                        );
                        $.each(data.data, function(index, grade) {
                            $("#grades,#single-grade").append(
                                '<option value="' +
                                    grade.id +
                                    '">' +
                                    grade.name +
                                    "</option>"
                            );
                        });
                    }
                },
                error: function(jqXhr, textStatus, errorMessage) {
                    alert(errorMessage);
                }
            });
        }
    });

    function loadClassesOnGradeChange(el) {
        var grade_id = $(el).val();
        if (grade_id) {
            $.ajax({
                url: APP_URL + "/api/class/" + grade_id,
                type: "get",
                success: function(data) {
                    if (data.status == 1) {
                        $classes.empty();
                        $classes.append(
                            '<option selected value="">Choose Class</option>'
                        );
                        $.each(data.data, function(index, schoolClass) {
                            $classes.append(
                                '<option value="' +
                                    schoolClass.id +
                                    '">' +
                                    schoolClass.name +
                                    "</option>"
                            );
                        });
                    }
                },
                error: function(jqXhr, textStatus, errorMessage) {
                    alert(errorMessage);
                }
            });
        }
    }

    $("#single-grade").change(function(e) {
        e.preventDefault();
        loadClassesOnGradeChange(this);
    });

    $grades.change(function(e) {
        e.preventDefault();
        loadClassesOnGradeChange(this);
    });

    $teacherDiv = $("#teacher-type");
    $studentDiv = $("#student-type");

    $("select[name=type]")
        .change(function() {
            $typeVal = $(this).val();
            switch ($typeVal) {
                case "teacher":
                    $teacherDiv.show();
                    $studentDiv.hide();
                    break;
                case "student":
                    $teacherDiv.hide();
                    $studentDiv.show();
                    break;
                default:
                    $teacherDiv.hide();
                    $studentDiv.show();
                    break;
            }
        })
        .change();
});

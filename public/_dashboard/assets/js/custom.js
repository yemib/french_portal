const update_crc_check_btn = $("#update-crc-check");

update_crc_check_btn.on("click", function () {
    let user_id = $(this).data("user");
    $.ajax({
        method: "get",
        url: webRoot + "/admin/fetch-crc-information/" + user_id,
        dataType: "application/json",
        contentType: "json"
    }).done(function (result) {

        console.log(result);
        toastr.success(result.message);
        window.location.reload(true);

    }).error(function (res) {
        //res = JSON.parse(result);
        console.log(res);
        alert("Error, check console for details");
    });
});

const application_information_section_head = $(".application-information-section").find(".head");
const application_information_section_body = $(".application-information-section").find(".body");

application_information_section_head.on("click", function() {
    let body_of_head_parent = $(this).parent().find(".body");
    if(body_of_head_parent.css("display") === "none") {
        application_information_section_body.hide();
        body_of_head_parent.slideDown();
    } else {
        application_information_section_body.slideUp();
    }
});
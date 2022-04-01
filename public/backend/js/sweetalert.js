$(function () {
    $(document).on("click", "#delete", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Delete this data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire("Deleted!", "Your data has been deleted.", "success");
            }
        });
    });
});

$(function () {
    $(document).on("click", "#confirm", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Do you want to Confirm?",
            text: "Once Confirmed, you will not be able to revert this",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Proceed",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire(
                    "Confirmed!",
                    "Order Status Changed to Confirmed",
                    "success"
                );
            }
        });
    });
});

$(function () {
    $(document).on("click", "#process", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Do you want to start Processing?",
            text: "Once Started, you will not be able to revert this",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Start Processing",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire(
                    "Processing Started!",
                    "Order Status Changed to Processing",
                    "success"
                );
            }
        });
    });
});

$(function () {
    $(document).on("click", "#pick", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Ready to be Picked?",
            text: "Once Picked, you will not be able to revert this",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Pick",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire(
                    "Picked!",
                    "Order Status Changed to Picked",
                    "success"
                );
            }
        });
    });
});

$(function () {
    $(document).on("click", "#ship", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Do you want to confirm Shipping?",
            text: "Once shipped, you will not be able to revert this",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire(
                    "Shipped!",
                    "Order Status Changed to Shipped",
                    "success"
                );
            }
        });
    });
});

$(function () {
    $(document).on("click", "#deliver", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Is it Delivered?",
            text: "Once Confirmed, you will not be able to revert this",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire(
                    "Delivered!",
                    "Order Status Changed to Delivered",
                    "success"
                );
            }
        });
    });
});

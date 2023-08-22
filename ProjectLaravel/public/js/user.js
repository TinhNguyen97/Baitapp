function deleteUser(id) {
    $("#delete-user").parents("form").attr("action", routeDelete(id));
}

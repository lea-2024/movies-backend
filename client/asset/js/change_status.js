const changeStatus = (id) => {
    let inputCheck = document.getElementById(`estado${id}`);
    console.log(id);
    console.log(inputCheck);
    let estado = inputCheck.checked ? 1 : 0;
    const params = new URLSearchParams();
    params.append('estado', estado);
    params.append('id', id);

    fetch('../../page/admin/update_status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: params.toString(),
    })
        .catch(error => console.log('Error al actualizar estado: ', error));
};



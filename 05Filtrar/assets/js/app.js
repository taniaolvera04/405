const agregarD = async () => {
    let dulce = document.getElementById("aDulce").value;
    let precio = document.getElementById("aPrecio").value;

    if (dulce.trim() == "" || precio.trim() == "") {
        Swal.fire({ title: "ERROR", text: "TIENES CAMPOS VACÍOS", icon: "error" });
        return;
    }

    datos = new FormData();
    datos.append("dulce", dulce);
    datos.append("precio", precio);
    datos.append('action', 'registrar');

    let respuesta = await fetch("php/dulcesMetodos.php", { method: 'POST', body: datos });
    let json = await respuesta.json();

    if (json.success == true) {
        Swal.fire({ title: "¡REGRISTRO ÉXITOSO!", text: json.mensaje, icon: "success" });
        limpiar();
    } else {
        Swal.fire({ title: "ERROR", text: json.mensaje, icon: "error" });
    }

    cargarDulces();
};

const cargarDulces = async () => {
    let i = document.getElementById("i").value;

    if (i.trim() == "") {
        Swal.fire({ title: "ERROR", text: "CAMPO VACÍO", icon: "error" });
        return;
    }

    datos = new FormData();
    datos.append("i", i);
    datos.append("action", "buscar");

    let respuesta = await fetch("php/dulcesMetodos.php", { method: 'POST', body: datos });
    let json = await respuesta.json();
    let tablaHTML = ``;
    json.data.forEach(item => {
        tablaHTML += `<tr>
        <td>${item[0]}</td>
        <td>${item[1]}</td>
        <td>${item[2]}</td>
        </tr>`;
    });
    document.getElementById("listaDulces").innerHTML = tablaHTML;
};

const buscarD = () => {
    cargarDulces();
};

const limpiar = () => {
    document.querySelector("#aDulce").value = "";
    document.querySelector("#aPrecio").value = "";
};


const cargarT = async () => {
    datos = new FormData();
    datos.append("action", "selectAll");

    let respuesta = await fetch("php/dulcesMetodos.php", { method: 'POST', body: datos });
    let json = await respuesta.json();
    let tablaHTML = ``;
    json.data.forEach(item => {
        tablaHTML += `<tr>
        <td>${item[0]}</td>
        <td>${item[1]}</td>
        <td>${item[2]}</td>
        </tr>`;
    });
    document.getElementById("listaDulces").innerHTML = tablaHTML;
};
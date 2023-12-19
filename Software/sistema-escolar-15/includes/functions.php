<?php
if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
            //casos de registros
        case 'insert_mat':
            insert_mat();
            break;

        case 'insert_grado':
            insert_grado();
            break;

        case 'insert_esp':
            insert_esp();
            break;

        case 'insert_prof':
            insert_prof();
            break;

        case 'insert_alumno':
            insert_alumno();
            break;

        case 'insert_apoderado':
            insert_apoderado();
            break;
        case 'insert_matricula':
            insert_matricula();
            break;

        case 'insert_conceptopenciones':
            insert_conceptopenciones();
            break;

        case 'editar_profe':
            editar_profe();
            break;

        

        case 'editar_alum':
            editar_alum();
            break;

        case 'editar_mat':
            editar_mat();
            break;

        case 'editar_grado':
            editar_grado();
            break;

        case 'editar_esp':
            editar_esp();
            break;


        case 'editar_user':
            editar_user();
            break;

        case 'editar_apoderado':
            editar_apoderado();
            break;


        case 'editar_matricula':
            editar_matricula();
            break;

            /*case 'delete':
            delete();
            break;

        case 'delete_s':
            delete_s();
            break;*/
    }
}


function insert_esp()
{
    require_once("db.php");
    extract($_POST);

    $consulta = "INSERT INTO especialidades (especialidad) VALUES ('$especialidad')";

    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado) {
        $response = array(
            'status' => 'success',
            'message' => 'Los datos se guardaron correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado'
        );
    }

    echo json_encode($response);
}

function insert_mat()
{
    global $conexion;
    extract($_POST);
    include "db.php";

    $consulta = "INSERT INTO cursos (NombreCurso, Descripcion) VALUES ('$NombreCurso', '$Descripcion')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $response = array(
            'status' => 'success',
            'message' => 'Los datos se guardaron correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado'
        );
    }

    echo json_encode($response);
}
function insert_conceptopensiones($dniEstudiante, $mes, $monto, $fechaVencimiento, $estadoPago) {
    include 'db.php'; // Asegúrate de que este archivo existe y es accesible

    // Utiliza sentencias preparadas para prevenir inyecciones SQL
    $stmt = $conexion->prepare("SELECT IdEstudiante FROM estudiantes WHERE DNI = ?");
    $stmt->bind_param("s", $dniEstudiante);
    $stmt->execute();
    $resultEstudiante = $stmt->get_result();

    if($row = $resultEstudiante->fetch_assoc()) {
        $idEstudiante = $row['IdEstudiante'];

        // Preparar la consulta SQL para insertar los datos de la pensión
        $insertStmt = $conexion->prepare("INSERT INTO pensiones (FKIdEstudiante, Mes, Monto, FechaVencimiento, EstadoPago) VALUES (?, ?, ?, ?, ?)");
        if($insertStmt) {
            // Vincular variables a la sentencia preparada como parámetros
            $insertStmt->bind_param("isds", $idEstudiante, $mes, $monto, $fechaVencimiento, $estadoPago);

            // Ejecutar la sentencia
            if($insertStmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Registro de pensión agregado exitosamente.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No se pudo ejecutar la consulta de inserción.']);
            }

            // Cerrar la sentencia
            $insertStmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo preparar la consulta de inserción.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se encontró un estudiante con el DNI proporcionado.']);
    }

    // Cerrar conexión
    $conexion->close();
}

// Asegúrate de capturar los valores correctos de POST y llamar a la función
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['accion'] == 'insert_conceptopensiones') {
    $dniEstudiante = $_POST['dniEstudiante'] ?? '';
    $mes = $_POST['mes'] ?? '';
    $monto = $_POST['monto'] ?? '';
    $fechaVencimiento = $_POST['fechaVencimiento'] ?? '';
    $estadoPago = $_POST['estadoPago'] ?? '';

    insert_conceptopensiones($dniEstudiante, $mes, $monto, $fechaVencimiento, $estadoPago);
}



function insert_grado()
{
    global $conexion;
    extract($_POST);
    include "db.php";

    $consulta = "INSERT INTO grados (NombreGrado, Orden, FKIdNivel) VALUES ('$NombreGrado', '$Orden', '$FKIdNivel')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $response = array(
            'status' => 'success',
            'message' => 'Los datos se guardaron correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado'
        );
    }

    echo json_encode($response);
}

function insert_matricula()
{
    global $conexion;
    extract($_POST);
    include "db.php";

    $consulta = "INSERT INTO matriculas (
        TipoMatricula, 
        FechaMatricula, 
        FKIdEstudiante, 
        FKIdGrado, 
        FKIdSeccion, 
        FKIdAnioEscolar, 
        EstadoDocumentos, 
        Estado
    ) VALUES (
        '$TipoMatricula', 
        '$FechaMatricula', 
        $FKIdEstudiante, 
        $FKIdGrado, 
        $FKIdSeccion, 
        $FKIdAnioEscolar, 
        '$EstadoDocumentos', 
        '$Estado'
    )";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $response = array(
            'status' => 'success',
            'message' => 'Los datos se guardaron correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado'
        );
    }

    echo json_encode($response);
}





function insert_prof()
{
    global $conexion;
    extract($_POST);
    include "db.php";

    $consulta = "INSERT INTO profesores (Nombres, ApellidoPaterno, ApellidoMaterno, Correo, Especialidad) 
    VALUES ('$nombre', '$apellido_paterno','$apellido_materno','$correo','$especialidad')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $response = array(
            'status' => 'success',
            'message' => 'Los datos se guardaron correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado'
        );
    }

    echo json_encode($response);
}



function insert_alumno()
{
    global $conexion;
    extract($_POST);
    include "db.php";

    $consulta = "INSERT INTO estudiantes (Nombres, Apellidos, DNI, FechaNacimiento) 
    VALUES ('$nombre', '$apellido', '$dni', '$fecha_nacimiento')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $response = array(
            'status' => 'success',
            'message' => 'Los datos se guardaron correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado'
        );
    }

    echo json_encode($response);
}


function insert_apoderado()
{
    require_once "db.php"; // Incluye la conexión a la base de datos

    // Obtén los datos del formulario
    $nombres = $_POST['nombres'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $dni = $_POST['dni'];
    $correo_personal = $_POST['correo_personal'];
    $celular = $_POST['celular'];
    $direccion = $_POST['direccion'];
    $relacion_estudiante = $_POST['relacion_estudiante'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    // Prepara la consulta SQL para evitar inyecciones SQL
    $consulta = $conexion->prepare("INSERT INTO apoderados (Nombres, ApellidoPaterno, ApellidoMaterno, DNI, CorreoPersonal, Celular, Direccion, RelacionEstudiante, FechaNacimiento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $consulta->bind_param('sssssssss', $nombres, $apellido_paterno, $apellido_materno, $dni, $correo_personal, $celular, $direccion, $relacion_estudiante, $fecha_nacimiento);

    // Ejecuta la consulta
    if ($consulta->execute()) {
        $response = array(
            'status' => 'success',
            'message' => 'Los datos del apoderado se guardaron correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error al guardar los datos del apoderado: ' . $consulta->error
        );
    }

    // Cierra la sentencia preparada
    $consulta->close();

    // Envía la respuesta en formato JSON
    echo json_encode($response);
}






function editar_matricula()
{
    global $conexion;
    extract($_POST);

    // Asegúrate de que los nombres de los campos coincidan con los de tu base de datos
    $consulta = "UPDATE matriculas SET
    TipoMatricula = '$TipoMatricula', 
    FechaMatricula = '$FechaMatricula', 
    FKIdEstudiante = '$FKIdEstudiante', 
    FKIdGrado = '$FKIdGrado', 
    FKIdSeccion = '$FKIdSeccion', 
    FKIdAnioEscolar = '$FKIdAnioEscolar', 
    EstadoDocumentos = '$EstadoDocumentos', 
    Estado = '$Estado'
    WHERE IdMatricula = '$IdMatricula'";


    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $response = array(
            'status' => 'success',
            'message' => 'La matrícula se actualizó correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error al actualizar la matrícula'
        );
    }

    echo json_encode($response);
}


function editar_mat()
{
    require_once("db.php");

    extract($_POST);

    $consulta = "UPDATE cursos SET NombreCurso = '$materia', Descripcion = '$descripcion' WHERE IdCurso = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo json_encode("correcto");
    } else {
        echo json_encode("error");
    }
}




function editar_grado()
{
    require_once("db.php");

    extract($_POST);

    $consulta = "UPDATE grados SET NombreGrado = '$nombre', Orden = '$orden', FKIdNivel = '$FKIdNivel' WHERE IdGrado = '$id'";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo json_encode("correcto");
    } else {
        echo json_encode("error");
    }
}

function editar_esp()
{
    require_once("db.php");

    extract($_POST);


    $consulta = "UPDATE especialidades SET especialidad = '$especialidad' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo json_encode("correcto");
    } else {
        echo json_encode("error");
    }
}

function editar_user()
{
    require_once("db.php");
    extract($_POST);
    $consulta = "UPDATE users SET usuario = '$usuario', correo = '$correo', id_rol='$id_rol' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo json_encode("correcto");
    } else {
        echo json_encode("error");
    }
}
function editar_profe()
{
    require_once("db.php");

    // No es recomendable usar extract() por razones de seguridad, pero para mantener la consistencia con tu ejemplo lo incluiré.
    extract($_POST);

    // Asegúrate de que las variables que extraes correspondan exactamente con los campos de tu formulario.
    $consulta = "UPDATE profesores SET Nombres = ?, ApellidoPaterno = ?, ApellidoMaterno = ?, Correo = ?, Especialidad = ? WHERE IdProfesor = ?";

    // Preparar la sentencia para evitar inyecciones SQL.
    if ($stmt = mysqli_prepare($conexion, $consulta)) {
        // Vincular los parámetros a la sentencia preparada.
        mysqli_stmt_bind_param($stmt, 'sssssi', $Nombres, $ApellidoPaterno, $ApellidoMaterno, $Correo, $Especialidad, $IdProfesor);

        // Obtener los valores de $_POST.
        $Nombres = $_POST['Nombres'];
        $ApellidoPaterno = $_POST['ApellidoPaterno'];
        $ApellidoMaterno = $_POST['ApellidoMaterno'];
        $Correo = $_POST['Correo'];
        $Especialidad = $_POST['Especialidad'];
        $IdProfesor = $_POST['IdProfesor'];

        // Ejecutar la consulta preparada.
        $resultado = mysqli_stmt_execute($stmt);

        // Cerrar la sentencia preparada.
        mysqli_stmt_close($stmt);

        if ($resultado) {
            echo json_encode(array("status" => "success", "message" => "Profesor actualizado correctamente"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Error al actualizar profesor"));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Error al preparar la consulta"));
    }
}


function editar_apoderado()
{
    require_once("db.php"); // Asegúrate de incluir el archivo de configuración de la base de datos

    // Recoger los datos del POST
    $id = $_POST['id'];
    $nombres = $_POST['nombres'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $dni = $_POST['dni'];
    $correo_personal = $_POST['correo_personal'];
    $celular = $_POST['celular'];
    $direccion = $_POST['direccion'];
    $relacion_estudiante = $_POST['relacion_estudiante'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    // Preparar la consulta para evitar inyecciones SQL
    $consulta = $conexion->prepare("UPDATE apoderados SET Nombres = ?, ApellidoPaterno = ?, ApellidoMaterno = ?, DNI = ?, CorreoPersonal = ?, Celular = ?, Direccion = ?, RelacionEstudiante = ?, FechaNacimiento = ? WHERE IdApoderado = ?");
    $consulta->bind_param('sssssssssi', $nombres, $apellido_paterno, $apellido_materno, $dni, $correo_personal, $celular, $direccion, $relacion_estudiante, $fecha_nacimiento, $id);

    // Ejecutar la consulta
    if ($consulta->execute()) {
        $response = array(
            'status' => 'success',
            'message' => 'Los datos del apoderado se actualizaron correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado al actualizar los datos del apoderado: ' . $consulta->error
        );
    }

    // Cerrar la sentencia preparada
    $consulta->close();

    // Enviar la respuesta en formato JSON
    echo json_encode($response);
}

function editar_alum()
{
    global $conexion;
    extract($_POST);

    // Asegúrate de que los nombres de los campos coincidan con los de tu base de datos
    $consulta = "UPDATE estudiantes SET
    Nombres = '$Nombres', 
    Apellidos = '$Apellidos', 
    DNI = '$DNI', 
    FechaNacimiento = '$FechaNacimiento', 
    Activo = '$Activo', 
    FKIdAnioEscolar = '$FKIdAnioEscolar', 
    Estado = '$Estado'
    WHERE IdMatricula = '$IdMatricula'";


    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $response = array(
            'status' => 'success',
            'message' => 'La matrícula se actualizó correctamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error al actualizar la matrícula'
        );
    }

    echo json_encode($response);
}




/*function delete()
{
    $id = $_POST['id'];
    require_once("db.php");


    $consulta = "DELETE FROM materias WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo 'success';
    } else {
        echo 'error';
    }
}

function delete_s()
{
    $id = $_POST['id'];
    require_once("db.php");


    $consulta = "DELETE FROM grados WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo 'success';
    } else {
        echo 'error';
    }
}
*/
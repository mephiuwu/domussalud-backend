<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FICHA ATENCIÓN CLÍNICA</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 800px;
            margin: auto;
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .form-group {
            display: flex;
            margin-bottom: 15px;
        }

        label {
            flex-basis: 30%;
            margin-right: 10px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            flex-basis: 70%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .section-title {
            background-color: #ddd;
            padding: 10px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .button-container {
            text-align: center;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h1>Ficha de Atención Clínica</h1>
    <form action="/clinical-record/generate/pdf" method="POST">
        @csrf
        <!-- Patient Information Section -->
        <div class="section-title">Información de Paciente</div>

        <div class="form-group">
            <label for="name">Nombre paciente:</label>
            <input type="text" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="rut">RUT:</label>
            <input type="text" id="rut" name="rut">
        </div>

        <div class="form-group">
            <label for="age">Edad:</label>
            <input type="number" id="age" name="age">
        </div>

        <!-- <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address">
        </div> -->

        <div class="form-group">
            <label for="phone">Fono:</label>
            <input type="text" id="phone" name="phone">
        </div>


        <div class="form-group">
            <label for="responsible_family_member">Familiar responsable:</label>
            <input type="text" placeholder="(Opcional)" id="responsible_family_member" name="responsible_family_member">
        </div>

        <div class="form-group">
            <label for="date">Fecha:</label>
            <input type="date" id="date" name="date">
        </div>

        <div class="section-title">Familiares con quien vive</div>

        <div class="form-group">
            <label for="older_adults">Adultos Mayores:</label>
            <input type="number" placeholder="0" id="older_adults" name="older_adults">
        </div>

        <div class="form-group">
            <label for="minor_adults">Adultos Menores:</label>
            <input type="number" placeholder="0" id="minor_adults" name="minor_adults">
        </div>

        <div class="form-group">
            <label for="children">Niños:</label>
            <input type="number" placeholder="0" id="children" name="children">
        </div>

        <div class="form-group">
            <label for="medications">Medicamentos/Tratamientos:</label>
            <textarea id="medications" placeholder="(Opcional)" name="medications" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="health_history">Antecedentes morbidos de salud:</label>
            <textarea id="health_history" placeholder="(Opcional)" name="health_history" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="reason">Motivo de consulta:</label>
            <input type="text" id="reason" name="reason">
        </div>

        <div class="form-group">
            <label for="anamnesis">Anamnesis:</label>
            <textarea id="anamnesis" placeholder="(Opcional)" name="anamnesis" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="physical_examination">Exámen físico:</label>
            <textarea id="physical_examination" placeholder="(Opcional)" name="physical_examination" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="diagnosis">Diagnóstico:</label>
            <textarea id="diagnosis" name="diagnosis" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="indications">Indicaciones:</label>
            <textarea id="indications" placeholder="(Opcional)" name="indications" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="others">Otros:</label>
            <textarea id="others" placeholder="(Opcional)" name="others" rows="3"></textarea>
        </div>

        <!-- Medical Information Section -->
        <div class="section-title">Información de médico</div>

        <div class="form-group">
            <label for="name_provider">Nombre prestador:</label>
            <input type="text" id="name_provider" name="name_provider">
        </div>

        <div class="form-group">
            <label for="rut_provider">RUT:</label>
            <input type="text" id="rut_provider" name="rut_provider">
        </div>

        <div class="form-group">
            <label for="registration_number">N° Registro:</label>
            <input type="text" id="registration_number" name="registration_number">
        </div>

        <div class="form-group">
            <label for="signature">Firma:</label>
            <textarea id="signature" name="signature" rows="5"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="button-container">
            <button type="submit">Enviar</button>
        </div>
    </form>
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const form = document.querySelector('form');

            let formData = new FormData(this);

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errorResponse => {
                            if (errorResponse.error) {
                                Swal.fire('Error', errorResponse.error, 'error');
                            }
                        });
                    }

                    return response.blob().then(blob => {
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = 'Ficha Clínica.pdf';
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url);
                    });
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire('Error', 'Ha ocurrido un error inesperado. Por favor, intenta nuevamente.', 'error');
                });
        });
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOMUS - FICHA ATENCIÓN CLÍNICA</title>
    <link rel="icon" href="{{ asset('images/logo_pdf.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F8F8ED;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            align-items: center;
            padding: 20px;
            background-color: #006B23;
            color: #F8F8ED;
            text-align: center;
        }

        .logo {
            height: 100px;
            margin-right: 20px;
        }

        h1 {
            flex: 1;
            font-size: 34px;
            margin: 0;
        }

        form {
            max-width: 800px;
            width: 90%;
            margin: 30px auto;
            border: 1px solid #C0D982;
            padding: 20px;
            background-color: #FFFFFF;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        input[type="date"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #C0D982;
            background-color: #F1F1F1;
            /* Cambiar a un fondo más suave */
        }

        @media (max-width: 600px) {
            .header {
                flex-direction: column;
                text-align: center;
            }

            .logo {
                height: 80px;
                margin-bottom: 10px;
            }

            h1 {
                font-size: 28px;
                margin-bottom: 10px;
            }
        }

        .form-group {
            display: flex;
            margin-bottom: 20px;
            /* margin-bottom: 15px; */
        }

        label {
            flex-basis: 30%;
            margin-right: 10px;
            font-weight: bold;
            color: #006B23;
        }

        input,
        textarea,
        select {
            flex-basis: 70%;
            padding: 8px;
            border: 1px solid #C0D982;
            border-radius: 4px;
            background-color: #F1F1F1;
            /* Cambié el color para hacerlo más suave */
        }

        .section-title {
            background-color: #71B700;
            padding: 10px;
            margin-bottom: 15px;
            font-weight: bold;
            color: #FFFFFF;
            border-radius: 4px;
        }

        .button-container {
            text-align: center;
        }

        button {
            padding: 12px 24px;
            background-color: #71B700;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s ease;
        }

        button:hover {
            background-color: #006B23;
            transform: scale(1.05);
            /* Efecto de aumento al pasar el cursor */
        }

        button:focus {
            outline: none;
            box-shadow: 0 0 5px 2px rgba(113, 183, 0, 0.6);
        }

        #signature {
            min-height: 100px;
            /* Aumentar el área para que sea más fácil de usar */
            border: 2px solid #C0D982;
            border-radius: 4px;
            padding: 8px;
            background-color: #F8F8ED;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ asset('images/logo_pdf.png') }}" alt="Company Logo" class="logo">
        <h1>Ficha de Atención Clínica</h1>
    </div>

    <form action="/clinical-record/generate/pdf" method="POST">
        @csrf
        <!-- Patient Information Section -->
        <div class="section-title">Información de Paciente</div>

        <br>

        <div class="form-group">
            <label for="name">Nombre Paciente</label>
            <input type="text" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="rut">RUT</label>
            <input type="text" id="rut" name="rut">
        </div>

        <div class="form-group">
            <label for="age">Edad</label>
            <input type="number" id="age" name="age">
        </div>

        <div class="form-group">
            <label for="phone">Fono</label>
            <input type="text" id="phone" name="phone">
        </div>

        <div class="form-group">
            <label for="responsible_family_member">Familiar responsable</label>
            <input type="text" placeholder="(Opcional)" id="responsible_family_member" name="responsible_family_member">
        </div>

        <div class="form-group">
            <label for="date">Fecha</label>
            <input type="date" id="date" name="date">
        </div>

        <div class="section-title">Familiares con quien vive</div>

        <br>

        <div class="form-group">
            <label for="older_adults">Adultos Mayores</label>
            <input type="number" placeholder="0" id="older_adults" name="older_adults">
        </div>

        <div class="form-group">
            <label for="minor_adults">Adultos Menores</label>
            <input type="number" placeholder="0" id="minor_adults" name="minor_adults">
        </div>

        <div class="form-group">
            <label for="children">Niños</label>
            <input type="number" placeholder="0" id="children" name="children">
        </div>

        <div class="form-group">
            <label for="medications">Medicamentos/Tratamientos</label>
            <textarea id="medications" placeholder="(Opcional)" name="medications" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="health_history">Antecedentes morbidos de salud</label>
            <textarea id="health_history" placeholder="(Opcional)" name="health_history" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="reason">Motivo de consulta</label>
            <input type="text" id="reason" name="reason">
        </div>

        <div class="form-group">
            <label for="anamnesis">Anamnesis</label>
            <textarea id="anamnesis" placeholder="(Opcional)" name="anamnesis" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="physical_examination">Exámen físico</label>
            <textarea id="physical_examination" placeholder="(Opcional)" name="physical_examination" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="diagnosis">Diagnóstico</label>
            <textarea id="diagnosis" name="diagnosis" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="indications">Indicaciones</label>
            <textarea id="indications" placeholder="(Opcional)" name="indications" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="others">Otros</label>
            <textarea id="others" placeholder="(Opcional)" name="others" rows="3"></textarea>
        </div>

        <!-- Medical Information Section -->
        <div class="section-title">Información de médico</div>

        <br>


        <div class="form-group">
            <label for="name_provider">Nombre Prestador</label>
            <input type="text" id="name_provider" name="name_provider">
        </div>

        <div class="form-group">
            <label for="rut_provider">RUT</label>
            <input type="text" id="rut_provider" name="rut_provider">
        </div>

        <div class="form-group">
            <label for="registration_number">N° de Registro</label>
            <input type="text" id="registration_number" name="registration_number">
        </div>

        <div class="form-group">
            <label for="signature">Firma</label>
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

                    Swal.fire('Ficha creada', 'Se ha generado con éxito', 'success');

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
                    Swal.fire('Error', 'Ha ocurrido un problema inesperado.', 'error');
                });
        });
    </script>
</body>

</html>
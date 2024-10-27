<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha Clínica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            position: relative;
        }

        .container {
            width: 100%;
            padding: auto;
            position: relative;
            z-index: 1;
        }

        table {
            width: 100%;
            border: 1px solid black;
            
            /* table-layout: fixed; */
            /* border-collapse: collapse; */
            border-spacing: 0;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .header {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 40%;
            transform: translate(-50%, -50%);
            opacity: 0.1;
            z-index: 0;
            transform: translate(-50%, -50%) rotate(-45deg);
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            /* Tamaño de la letra del título reducido */
            color: #1A5529;
        }

        .subtitle {
            text-align: center;
            font-size: 14px;
            /* Tamaño de la letra del RUT reducido */
        }

        .company-info {
            text-align: left;
            font-size: 12px;
            font-weight: bold;
            color: #1A5529;
        }

        .header-table {
            background-color: #E2EBD7;
        }

        .header-table td {
            border: none;
        }

        .field {
            font-family: 'Corbel', sans-serif;
            font-size: 12px;
            font-weight: bold;
            background-color: #E2EBD7;
        }
    </style>
</head>

<body>
    <div class="watermark">
        <img src="{{ public_path('images/watermark.png') }}" alt="Marca de Agua" style="width: 130%; height: auto;">
    </div>

    <div class="container">
        <table class="header-table">
            <tr>
                <td style="width: 20%; padding-left: 30px">
                    <img src="{{ public_path('images/logo_pdf.png') }}" alt="Logo" style="width: 80px; width: 80px; height: auto;">
                </td>
                <td class="title">FICHA DE ATENCIÓN CLÍNICA</td>
                <td class="company-info" style="width: 20%;">DOMUS SALUD SPA <br> RUT: 78.010.853-3</td>
            </tr>
        </table>

        <table style="width: 100%; border-spacing: 0; border-collapse: collapse;">
            <tr>
                <td style="height: 2px; background-color: transparent;"></td> <!-- Espacio sin borde -->
            </tr>
        </table>

        <table>
            <tr>
                <td class="field">Nombre Paciente</td>
                <td colspan="3">{{ $data['name'] }}</td>
                <td class="field">N° Ficha</td>
                <td>{{$data['number']}}</td>
            </tr>

            <tr>
                <td class="field">RUT</td>
                <td>{{ $data['rut'] }}</td>
                <td class="field">Edad</td>
                <td>{{ $data['age'] }}</td>
                <td class="field">Fono</td>
                <td>{{ $data['phone'] }}</td>
            </tr>

            <tr>
                <td class="field">Familiar Responsable</td>
                <td colspan="3">{{ $data['responsible_family_member'] }}</td>
                <td class="field">Fecha</td>
                <td>{{ $data['date'] }}</td>
            </tr>

            <tr>
                <td class="field" colspan="2">FAMILIARES CON QUIEN VIVE</td>
                <td class="field" colspan="4" style="border-right: 1px solid black;">ANTECEDENTES MORBIDOS DE SALUD</td>
            </tr>

            <tr>
                <td class="field">ADULTOS MAYORES</td>
                <td>{{ $data['older_adults'] }}</td>
                <td colspan="4" rowspan="9" style="border: 1px solid black;">{{ $data['health_history'] }}</td>
            </tr>

            <tr>
                <td class="field">ADULTOS MENORES</td>
                <td>{{ $data['minor_adults'] }}</td>
            </tr>

            <tr>
                <td class="field">NIÑOS</td>
                <td>{{ $data['children'] }}</td>
            </tr>

            <tr>
                <td class="field" colspan="2">MEDICAMENTOS/TRATAMIENTOS</td>
            </tr>

            <tr>
                <td colspan="2" rowspan="5">{{ $data['medications'] }}</td>
            </tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>

            <tr>
                <td class="field">Motivo de Consulta</td>
                <td colspan="5">{{ $data['reason'] }}</td>
            </tr>

            <tr>
                <td class="field">Anamnesis</td>
                <td colspan="5">{{ $data['anamnesis'] }}</td>
            </tr>

            <tr>
                <td class="field">Examen Físico</td>
                <td colspan="5">{{ $data['physical_examination'] }}</td>
            </tr>

            <tr>
                <td class="field">Diagnóstico</td>
                <td colspan="5">{{ $data['diagnosis'] }}</td>
            </tr>

            <tr>
                <td class="field">Indicaciones</td>
                <td colspan="5">{{ $data['indications'] }}</td>
            </tr>

            <tr>
                <td class="field">Otros</td>
                <td colspan="5">{{ $data['others'] }}</td>
            </tr>

            <tr>
                <td class="field">Nombre del Médico</td>
                <td colspan="3">{{ $data['name_provider'] }}</td>
                <td class="field">N° Registro</td>
                <td>{{ $data['registration_number'] }}</td>
            </tr>

            <tr>
                <td class="field">RUT del Médico</td>
                <td>{{ $data['rut_provider'] }}</td>
                <td class="field">Firma</td>
                <td colspan="3">{{ $data['signature'] }}</td>
            </tr>
        </table>

    </div>
</body>

</html>
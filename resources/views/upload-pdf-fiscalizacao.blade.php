<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    {{-- @vite(['resources/js/app.js']) --}}
</head>

<body>
    <div class="container" style="margin-top: 20px">
        <form action="/upload" method="POST" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            <div class="form-group">
                <label for="pdf_file" class="col-sm-2 control-label">Arquivo PDF</label>
                <div class="col-sm-4">
                    <input type="file" class="form-control" name="pdf_file" id="pdf_file" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </form>
        <div class="col-md-12">
            <div class="container">
                <h3>ANÁLISE DAS DEMONSTRAÇÕES CONTÁBEIS</h3>
                <div style="width:90%;">

                    @if (isset($messageValidFile))
                        {{ $messageValidFile }}
                    @endif

                    {{-- @if (isset($validationErrors))
                    {{ $validationErrors }}
                     @endif --}}

                    @if (isset($response))
                        {{ $response }}
                    @endif
                </div>
            </div>
        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>

<style>
    .buttons {
        margin-left: auto;
        width: 15%;
    }

    .btn {
        margin-top: 10px;
        padding: 6px;
        font-size: 0.9em;
        line-height: 0.9em;
    }
</style>

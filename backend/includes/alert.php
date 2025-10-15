<div id="meuAlert" style="
    display:none;
    position:fixed;
    top:30%;
    left:50%;
    transform:translate(-50%, -50%);
    background:#333;
    color:#fff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.5);
    z-index:9999;
">
    <span id="mensagemAlert"></span>
    <br><br>
    <button onclick="fecharAlert()">Fechar</button>
</div>

<script>
    function mostrarAlert(msg) {
        document.getElementById('mensagemAlert').innerText = msg;
        document.getElementById('meuAlert').style.display = 'block';
    }

    function fecharAlert() {
        document.getElementById('meuAlert').style.display = 'none';
    }

</script>
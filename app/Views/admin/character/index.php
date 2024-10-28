<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des utilisateurs</h4>
        <a href="/admin/character/new"><i class="fa-solid fa-user-plus"></i></a>
    </div>
    <div class="card-body">
        <table id="character" class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>lié à</th>
                <th>Nom</th>
                <th>Force</th>
                <th>Constitution</th>
                <th>Agilité</th>
                <th>Experience</th>
                <th>Niveau</th>
                <th>Modifier</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function (){
        var baseUrl = "<?= base_url(); ?>";
        var dataTable = $('#character').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLenght": 10,
            "language": {
                url: '<?= base_url("/js/datatable/datatable-2.1.4-fr-FR.json") ?>',
            },
            "ajax": {
                "url": "<?= base_url('admin/character/SearchCharacter') ?>",
                "type": "POST"
            },
            "columns": [
                {"data": "id"},
                {"data": "user_id"}

            ]
        })
    })
</script>
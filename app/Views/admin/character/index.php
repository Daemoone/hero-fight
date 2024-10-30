<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des personnages</h4>
        <a href="/admin/character/new"><i class="fa-solid fa-user-plus"></i></a>
    </div>
    <div class="card-body">
        <table id="tableCharacter" class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Nom</th>
                <th>Force</th>
                <th>Constitution</th>
                <th>Agilité</th>
                <th>Experience</th>
                <th>Niveau</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        var baseUrl = "<?= base_url(); ?>";
        var dataTable = $('#tableCharacter').DataTable({
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
                {"data": "user_id"},
                {"data": "name"},
                {"data": "strengh"},
                {"data": "constitution"},
                {"data": "agility"},
                {"data": "experience"},
                {"data": "level"},
                {
                    data : 'id',
                    sortable : false,
                    render : function(data) {
                        return `<a href="/admin/character/${data}"><i class="fa-solid fa-pencil"></i></a>`;
                    }
                },
                {
                    data : 'id',
                    sortable : false,
                    render : function(data) {
                        return `<a class="swal2-character" id="${data}" swal2-title="Êtes-vous sûre de vouloir supprimer personnage ?" swal2-text="" href="<?= base_url('/admin/character/deletecharacter/');?> ${data}"><i class="fa-solid fa-trash text-danger"></i></a>`;
                    }
                }
            ]
        });

        $("body").on('click', '.swal2-character', function(event) {
            event.preventDefault();
            let title = $(this).attr("swal2-title");
            let text = $(this).attr("swal2-text");
            let link = $(this).attr('href');
            let id = $(this).attr('id');
            if (id == 1){
                Swal.fire('On ne peut pas supprimer');
            } else {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url('admin/character/totalcharacterbyid');?>",
                    data: {
                        id: id,
                    },
                    success: function (data) {
                        let json = JSON.parse(data)
                        console.log(json.total);
                    }
                })
            }
        });
    })
</script>
<div class="row">
    <div class="col">
        <form action="<?= isset($character) ? "/admin/character/update" : "/admin/character/create" ?>" method="POST" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <?= isset($character) ? "Editer " . $character['name'] : "Créer un personnage" ?>
                    </h4>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="character-tab" data-bs-toggle="tab" data-bs-target="#character-pane" type="button" role="tab" aria-controls="general" aria-selected="true">Profil</button>
                    </li>
                </ul>
                <!-- tab -->
                <div class="tab-content p-3">
                    <div class="tab-pane fade show active" id="character-pane"
                         role="tabpanel" aria-labelledby="character-tab" tabindex="0">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="name" placeholder="name" value="<?= isset($character) ? $character['name'] : "" ?>" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="strengh" class="form-label">Force</label>
                                <input type="text" class="form-control" id="strengh" placeholder="strengh" value="<?= isset($character) ? $character['strengh'] : "" ?>" name="strengh">
                            </div>
                            <div class="mb-3">
                                <label for="constitution" class="form-label">Constitution</label>
                                <input type="text" class="form-control" id="constitution" placeholder="constitution" value="<?= isset($character) ? $character['constitution'] : "" ?>" name="constitution">
                            </div>
                            <div class="mb-3">
                                <label for="agility" class="form-label">Agilité</label>
                                <input type="text" class="form-control" id="agility" placeholder="agility" value="<?= isset($character) ? $character['agility'] : "" ?>" name="agility">
                            </div>
                            <div class="mb-3">
                                <label for="experience" class="form-label">Experience</label>
                                <input type="text" class="form-control" id="experience" placeholder="experience" value="<?= isset($character) ? $character['experience'] : "" ?>" name="experience">
                            </div>
                            <div class="mb-3">
                                <label for="level" class="form-label">Level</label>
                                <input type="text" class="form-control" id="level" placeholder="level" value="<?= isset($character) ? $character['level'] : "" ?>" name="level">
                            </div>
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Id Utilisateur</label>
                                <input type="text" class="form-control" id="user_id" placeholder="utilisateur" value="<?= isset($character) ? $character['user_id'] : "" ?>" name="user_id">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <?php if (isset($character)): ?>
                        <input type="hidden" name="id" value="<?= $character['id']; ?>">
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary">
                        <?= isset($character) ? "Sauvegarder" : "Enregistrer" ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
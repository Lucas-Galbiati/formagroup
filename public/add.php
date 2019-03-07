<?php
require '../src/bootstrap.php';
render('header', ['title' => 'Ajouter un évènement']);

$data = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $errors = [];
    $validator = new Calendar\EventValidator();
    $errors = $validator->validates($_POST);
    if (empty($errors)) {
        $event = new \Calendar\Event();
        $event->setName($data['name']);
        $event->setDescription($data['description']);
        $event->setStart(DateTime::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $data['start'])->format('Y-m-d H:i:s'));
        $event->setEnd(DateTime::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $data['end'])->format('Y-m-d H:i:s'));
        $events = new \Calendar\Events(get_pdo());
        $events->create($event);
        header('Location: /index?success=1');
        exit();

    }
}
?>



<div class="container">

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            Merci  de corriger vos erreurs
        </div>
    <?php endif; ?>

    <h1>Ajouter un évènement</h1>
    <form action="" method="post" class="form">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Titre</label>
                    <input id="name" type="text" required class="form-control" name="name" value="<?= isset($data['name']) ? h($data['name']) : ''; ?>">
                    <?php if (isset($errors['name'])): ?>
                      <small class="form-text text-muted"><?= $errors['name']; ?></small>  
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input id="date" type="date" required  class="form-control" name="date" value="<?= isset($data['date']) ? h($data['date']) : ''; ?>">
                    <?php if (isset($errors['date'])): ?>
                      <small class="form-text text-muted"><?= $errors['date']; ?></small>  
                    <?php endif; ?>
                </div>
            </div>
        </div>     
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="start">Démarrage</label>
                    <input id="start" type="time" required  class="form-control" name="start" placeholder="HH:MM" value="<?= isset($data['start']) ? h($data['start']) : ''; ?>">
                    <?php if (isset($errors['start'])): ?>
                      <small class="form-text text-muted"><?= $errors['start']; ?></small>  
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="end">Fin</label>
                    <input id="end" type="time" required  class="form-control" name="end" placeholder="HH:MM" value="<?= isset($data['end']) ? h($data['end']) : ''; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"><?= isset($data['description']) ? h($data['description']) : ''; ?></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Ajouter l'évènement</button>
        </div>
    </form>
</div>
<?php render('footer'); ?>
<?php include_once "./head.php" ?>



<div class="p-3">
    <h2>Create Friend Card</h2>

    <form action="fri-logic.php" method="POST" enctype="multipart/form-data">
        <div class="mb-2">
            <label for="" class=" form-label">Friend Name</label>
            <input type="text" class=" form-control" required name="fri_name">
        </div>

        <div class="mb-2">
            <label for="" class=" form-label">Friend Phone</label>
            <input type="tel" class=" form-control" required name="fri_phone">
        </div>

        <div class="mb-2">
            <label for="" class=" form-label">Friend Address</label>
            <textarea rows="5" class=" form-control" required name="fri_address"></textarea>
        </div>

        <div class="mb-2">
            <label for="" class=" form-label">Friend Photo</label>
            <input type="file" class=" form-control" required name="fri_photo" accept="image/jpeg,image/png">
        </div>

        <div class=" form-check my-2">
            <input type="checkbox" name="isReal" value="yes" id="isReal" class=" form-check-input">
            <label for="isReal" class=" form-check-label">Real Friend</label>
        </div>

        <button class="btn btn-primary w-100">Create Friend Card</button>
    </form>

    <div class=" my-5 gap-3">
        <?php 
            $dataFileName = "friend-detail.json";
            
            $friends = json_decode(file_get_contents($dataFileName),true);
        ?>

        <?php foreach($friends as $key => $friend): ?>
            <div class="card">
                <div class=" card-body text-center">
                    <img src="<?= $friend["photo"] ?>" alt="" class="rounded-circle object-fit-cover" width="100" height="100">
                    <h4><?= $friend["name"] ?></h4>
                    <p><?= $friend["phone"] ?></p>
                    <p><?= $friend["address"] ?></p>
                    <a href="./friend-detail.php?index=<?= $key ?>" class=" btn btn-primary w-100">Detail</a>
                    <a href="./friend-delete.php?index=<?= $key ?>" class=" btn btn-danger w-100 mt-2">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include_once "./foot.php" ?>
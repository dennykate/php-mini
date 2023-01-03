<?php require_once "head.php" ?>

<div class="p-3">
    <h3>Exchange Calculator</h3>

    <?php require_once "ex-logic.php" ?>

    <form method="POST" id="exForm"></form>

    <div class="row g-3">
        <div class="col-12">
            <label class=" form-label" for="">Amount</label>
            <input class=" form-control" type="number" name="amount" required form="exForm">
        </div>
        <div class="col-6">
            <label class=" form-label" for="">From Currency</label>
            <select class=" form-select" name="from" id="" form="exForm">
                <option value="">ရွေးချယ်ပါ</option>
               <?php foreach($rates as $key => $value): ?>
                    <option value="<?= $key ?>"><?= $key ?></option>
               <?php endforeach ?>
            </select>
        </div>
        <div class="col-6">
        <label class=" form-label" for="">To Currency</label>
            <select class=" form-select" name="to" id="" form="exForm">
                <option value="">ရွေးချယ်ပါ</option>
                <?php foreach($rates as $key => $value): ?>
                    <option value="<?= $key ?>"><?= $key ?></option>
               <?php endforeach ?>
            </select>
        </div>
        <div class="col-12">
            <button name="calc" class="btn btn-primary w-100 btn-lg" form="exForm">Calculate</button>
        </div>
    </div>

    <?php 
        $totalFiles = scandir("exchange-records");
        $records = array_filter($totalFiles,fn($file) => $file != "." && $file != "..");

        $records = array_reverse($records);

        if(count($records)):

    ?>

    <table class=" table table-bordered mt-3">
        <thead>
            <tr>
                <th>Amount</th>
                <th>From</th>
                <th>To</th>
                <th>Result</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
           
                <?php foreach($records as $record): ?>
                    <tr>
                    <?php 
                        $fileOpen = fopen("exchange-records/".$record,"r");
                        $json = fread($fileOpen,filesize("exchange-records/".$record));    
                        $decodedJson = json_decode($json,true);

                        
                    ?>
                        <td><?= $decodedJson['amount'] ?></td>
                        <td><?= $decodedJson['from'] ?></td>
                        <td><?= $decodedJson['to'] ?></td>
                        <td><?= $decodedJson['result'] ?></td>
                        <td>
                            <a 
                                href="delete-exchange-record.php?name=<?= $record ?>" 
                                class="btn btn-danger btn-sm"
                                
                            >Delete
                        </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            
        </tbody>
    </table>

    <?php endif; ?>

</div>

<?php require_once "foot.php" ?>
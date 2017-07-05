<?php
/* @var $this yii\web\View */
/* @var $model  yii\base\DynamicModel */
?>

<script>
    window.parent.CKEDITOR.tools.callFunction("<?= $_REQUEST['CKEditorFuncNum'] ?>", "<?= $model->file ?>", "<?= $message ?>");
</script>


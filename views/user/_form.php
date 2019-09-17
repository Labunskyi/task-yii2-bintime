<?php
use app\models\Parcel;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Add-user';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if( Yii::$app->session->hasFlash('success') ): ?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo Yii::$app->session->getFlash('success'); ?>
	</div>
<?php endif;?>
<div class="product-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false, // TODO get this working with client validation
    ]); ?>


    <fieldset>
        <legend>Add user</legend>
		<?= $form->field($model->product, 'login')->textInput()?>
		<?= $form->field($model->product, 'password')->passwordInput()?>
		<?= $form->field($model->product, 'name')->textInput()?>
		<?= $form->field($model->product, 'surname')->textInput()?>
		<?= $form->field($model->product, 'gender')->dropDownList(
			['Men' =>'Men','Women' =>'Women','Not information' => 'Not information'],
			['prompt' => 'Choose the gender']
		) ?>
		<?= $form->field($model->product, 'email')->input('email')?>
    </fieldset>

    <fieldset>
		<legend>Add address</legend>

        <?php

        $parcel = new Parcel();
        $parcel->loadDefaultValues();
        echo '<table id="product-parcels" class="table table-condensed table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>' . $parcel->getAttributeLabel('post_index') . '</th>';
        echo '<th>' . $parcel->getAttributeLabel('country') . '</th>';
        echo '<th>' . $parcel->getAttributeLabel('city') . '</th>';
        echo '<th>' . $parcel->getAttributeLabel('street') . '</th>';
        echo '<th>' . $parcel->getAttributeLabel('house') . '</th>';
		echo '<th>' . $parcel->getAttributeLabel('appartment') . '</th>';
		echo '<th>' . '</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        
        // existing parcels fields
        foreach ($model->parcels as $key => $_parcel) {
          echo '<tr>';
          echo $this->render('_form-product-parcel', [
            'key' => $_parcel->isNewRecord ? (strpos($key, 'new') !== false ? $key : 'new' . $key) : $_parcel->id,
            'form' => $form,
            'parcel' => $_parcel,
          ]);
          echo '</tr>';
        }
        
        // new parcel fields
        echo '<tr id="product-new-parcel-block" style="display: none;">';
        echo $this->render('_form-product-parcel', [
            'key' => '__id__',
            'form' => $form,
            'parcel' => $parcel,
        ]);
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
        
        // OPTIONAL: register JS assets as required for widgets
      
        ?>
		<?php
            // new address button
            echo Html::a('New Address', 'javascript:void(0);', [
              'id' => 'product-new-parcel-button', 
              'class' => 'pull-right btn btn-default btn-xs'
            ])
            ?>
        <?php ob_start(); // output buffer the javascript to register later ?>
        <script>
            
            // add parcel button
            var parcel_k = <?php echo isset($key) ? str_replace('new', '', $key) : 0; ?>;
            $('#product-new-parcel-button').on('click', function () {
                parcel_k += 1;
                $('#product-parcels').find('tbody')
                  .append('<tr>' + $('#product-new-parcel-block').html().replace(/__id__/g, 'new' + parcel_k) + '</tr>');
            });
            
            // remove parcel button
				
				$(document).on('click', '.product-remove-parcel-button', function () {
						if ($(this)[0].outerText === 'Remove new1') {
							alert('The address is required');
						} else {
							$(this).closest('tbody tr').remove()
						}
						
				});
			
            
            <?php
            // OPTIONAL: click add when the form first loads to display the first new row
            if (!Yii::$app->request->isPost && $model->product->isNewRecord) 
              echo "$('#product-new-parcel-button').click();";
            ?>
 
           
        </script>
        <?php $this->registerJs(str_replace(['<script>', '</script>'], '', ob_get_clean())); ?>

    </fieldset>

    <?= Html::submitButton('Add', ['class' => 'btn btn-sm btn-success'])?> <?= Html::a('Cancel', ['site/index'], ['class' => 'btn btn-sm btn-primary']) ?>
    <?php ActiveForm::end(); ?>

</div>
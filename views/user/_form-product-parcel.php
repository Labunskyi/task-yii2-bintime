<?php
use app\models\Parcel;
use yii\helpers\Html;
?>
<td>
    <?= $form->field($parcel, 'post_index')->textInput([
        'id' => "Parcels_{$key}_post_index",
        'name' => "Parcels[$key][post_index]",
    ])->label(false) ?>
</td>

<td>
    <?= $form->field($parcel, 'country')->textInput([
        'id' => "Parcels_{$key}_country",
        'name' => "Parcels[$key][country]",
    ])->label(false) ?>
</td>

<td>
    <?= $form->field($parcel, 'city')->textInput([
        'id' => "Parcels_{$key}_city",
        'name' => "Parcels[$key][city]",
    ])->label(false) ?>
</td>

<td>
    <?= $form->field($parcel, 'street')->textInput([
        'id' => "Parcels_{$key}_street",
        'name' => "Parcels[$key][street]",
    ])->label(false) ?>
</td>

<td>
    <?= $form->field($parcel, 'house')->textInput([
        'id' => "Parcels_{$key}_house",
        'name' => "Parcels[$key][house]",
    ])->label(false) ?>
</td>

<td>
    <?= $form->field($parcel, 'appartment')->textInput([
        'id' => "Parcels_{$key}_appartment",
        'name' => "Parcels[$key][appartment]",
    ])->label(false) ?>
</td>

<td>
    <?= Html::a('Remove ' . $key, 'javascript:void(0);', [
      'class' => 'product-remove-parcel-button btn btn-default btn-xs',
    ]) ?>
</td>

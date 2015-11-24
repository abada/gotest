<div class="col-md-6 pharmacy">
    <h2><?= $item->title?></h2>
    <dl class="dl-horizontal">
        <dt><i class="fa fa-map-marker fa-2x"></i></dt>
        <dd><?= $item->address .' , '.$item->district.' , '.$item->city .' , '.$item->government?></dd>
        <dt><i class="fa fa-phone fa-2x"></i></dt>
        <dd><?= $item->phone ;?><br></dd>
    </dl>
</div>
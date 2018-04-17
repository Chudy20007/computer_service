<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('name','Nazwa części:') !!}
        </div>
        <div class='col-md-12'>
                {!! Form::text('name',null,['class'=>'form-control','required' =>true]) !!}
        </div>
</div>
<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('price','Cena:') !!}
        </div>
        <div class='col-md-12 col-sm-12 form-select-control'>
                {!! Form::text('price',null,['class'=>'form-control','required' =>true]) !!}
        </div>
</div>

<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('serial_number','Kod produktu (EAN):') !!}
        </div>
        <div class='col-md-12 col-sm-12'>
                {!! Form::text('serial_number',null,['class'=>'form-control','required' =>true]) !!}
        </div>
</div>

<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('count','Sztuk:') !!}
        </div>
        <div class='col-md-12 col-sm-12'>
                {!! Form::text('count',null,['class'=>'form-control','required' =>true]) !!}
        </div>
</div>

<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('category_id','Kategoria produktu:') !!}
        </div>
       
        <div class='col-md-12 col-sm-12 form-select-control'>
                {{ Form::select('category_id' ,$categories,null,['class'=>'form-select-control select-2','required' =>true]) }}
        </div>
</div>


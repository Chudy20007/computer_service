<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('name','Nazwa części:') !!}
        </div>
        <div class='col-md-12'>
                {!! Form::text('name',$part->name,['class'=>'form-control']) !!}
        </div>
</div>
<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('price','Cena:') !!}
        </div>
        <div class='col-md-12 col-sm-12 form-select-control'>
                {!! Form::text('price',$part->price,['class'=>'form-control']) !!}
        </div>
</div>

<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('serial_number','Kod seryjny (EAN):') !!}
        </div>
        <div class='col-md-12 col-sm-12'>
                {!! Form::text('serial_number',$part->serial_number,['class'=>'form-control']) !!}
        </div>
</div>

<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('count','Sztuk:') !!}
        </div>
        <div class='col-md-12 col-sm-12'>
                {!! Form::text('count',$part->count,['class'=>'form-control']) !!}
        </div>
</div>

<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('category_id','Kategoria produktu:') !!}
        </div>
       
        <div class='col-md-12 col-sm-12 form-select-control'>
                {!! Form::select('category_id' ,$categories,$part->category_id,['class'=>'form-select-control select-2']) !!}
                {!! Form::hidden('id',$part->id,['class'=>'form-control']) !!}
        </div>
</div>


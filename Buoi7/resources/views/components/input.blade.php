@props(['name','label'=>null,'type'=>'text','value'=>''])
<label style="display:block;margin:8px 0 4px">{{ $label ?? ucfirst($name)
}}</label>
<input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}"

    style="width:100%;padding:8px;border:1px solid #e5e7eb;border-radius:6px">

@error($name)
<div style="color:#991B1B;margin-top:4px">{{ $message }}</div>
@enderror
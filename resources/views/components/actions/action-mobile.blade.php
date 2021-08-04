@props(['action'])
@decodeWireAttributes

<x-dynamic-component 
    :component="$action->getComponent('icon-text-button')" 
    :icon="$action->icon" 
    :text="$action->title" {{$attributes}}/> 
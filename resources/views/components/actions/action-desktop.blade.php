@props(['action'])
@decodeWireAttributes

<x-dynamic-component :component="$action->getComponent('icon-button')" :icon="$action->icon" size="sm"  {{$attributes}}/>
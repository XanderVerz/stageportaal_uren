<!-- resources/views/components/flash-message.blade.php -->

<div 
    x-data="{show: true}"
    x-init="setTimeout(() => show = false, 3000)"
    x-show="show"
    {{ $attributes->merge(['class' => 'fixed top-0 left-1/2 transform -translate-x-1/2 px-48 py-3']) }}>
    <p>
        {{ $slot }}
    </p>
</div>


<style>
    .bg-success {
        background-color: #4F7942;
    }
    .bg-error {
        background-color: #A82A2A;
    }
    .bg-warning {
        background-color: #EAB308;
    }
<div class="drawer  drawer-end flex-1 flex flex-col">
    <input id="my-drawer-1" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex-1 flex flex-col " wire:listen="side-drawer-closed">
        <!-- Page content here -->


        {{-- <label for="my-drawer-1" class="btn drawer-button">Open drawer</label> --}}
    </div>
    <div class="drawer-side"  >
        <label for="my-drawer-1" aria-label="close sidebar" class="drawer-overlay" ></label>
      
        <ul class="menu bg-base-200 min-h-full w-80 p-4">
            <!-- Sidebar content here -->




           
                <livewire:shopping-cart :isDrawer="true" />
           





        </ul>
    </div>
</div>

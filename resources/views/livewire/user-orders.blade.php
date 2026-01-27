<div class="overflow-x-auto mt-20">
    <style>
      @media (max-width: 768px) {
        /* Hide regular table headers on mobile */
        .responsive-table thead,
        .responsive-table tfoot {
          display: none;
        }
        
        /* Make each row a block with borders */
        .responsive-table tbody tr {
          display: block;
          border: 1px solid #e5e7eb;
          border-radius: 0.5rem;
          margin-bottom: 1rem;
          padding: 1rem;
          background-color: white;
          box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        /* Remove table borders and make cells block */
        .responsive-table tbody td,
        .responsive-table tbody th {
          display: block;
          padding: 0.5rem 0;
          border: none;
          text-align: left;
        }
        
        /* Make the row number (th) look like a badge */
        .responsive-table tbody tr > th:first-child {
          display: none;
        }
        
        /* Create the label-value pairs */
        .mobile-row {
          display: flex;
          align-items: center;
          padding: 0.5rem 0;
          border-bottom: 1px solid #f3f4f6;
        }
        
        .mobile-row:last-child {
          border-bottom: none;
        }
        
        .mobile-label {
          font-weight: bold;
          min-width: 120px;
          color: #374151;
          font-size: 0.875rem;
        }
        
        .mobile-value {
          flex: 1;
          color: #111827;
        }
      }
    </style>
    
    <table class="table  responsive-table">
      <thead class="hidden md:table-header-group">
        <tr>
          {{-- <th></th> --}}
          <th>Order</th>
          <th>Date</th>
          <th>Status</th>
          <th>Total</th>
          <th>Action</th>
          
        </tr>
      </thead>
      <tbody>
        <!-- Row 1 -->
        @foreach ($orders as $order )
        <tr class="group">
            {{-- <th>1</th> --}}
            <td class="md:table-cell">
              <div class="mobile-row">
                <span class="mobile-label md:hidden">Order:</span>
                <span class="mobile-value">#{{$order->order_number}}</span>
              </div>
            </td>
            <td class="md:table-cell">
              <div class="mobile-row">
                <span class="mobile-label md:hidden">Date:</span>
                <span class="mobile-value">{{$order->formatted_created_at}}</span>
              </div>
            </td>
            <td class="md:table-cell">
              <div class="mobile-row">
                <span class="mobile-label md:hidden">Status:</span>
                <span class="mobile-value">{{$order->status}}</span>
              </div>
            </td>
            <td class="md:table-cell">
              <div class="mobile-row">
                <span class="mobile-label md:hidden">Total:</span>
                <span class="mobile-value"> <strong>{{$order->total}}EGP</strong> for <strong>{{$order->items()->count()}}</strong> </span>
              </div>
            </td>
           
            <td class="md:table-cell">
              <div class="mobile-row">
                <span class="mobile-label md:hidden">Action:</span>
                <span class="mobile-value">View</span>
              </div>
            </td>
          </tr>
        @endforeach
       
        
        {{-- <!-- Row 2 -->
        <tr class="group">
          <th>2</th>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Name:</span>
              <span class="mobile-value">Hart Hagerty</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Job:</span>
              <span class="mobile-value">Desktop Support Technician</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Company:</span>
              <span class="mobile-value">Zemlak, Daniel and Leannon</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Location:</span>
              <span class="mobile-value">United States</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Last Login:</span>
              <span class="mobile-value">12/5/2020</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Favorite Color:</span>
              <span class="mobile-value">Purple</span>
            </div>
          </td>
        </tr>
        
        <!-- Row 3 -->
        <tr class="group">
          <th>3</th>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Name:</span>
              <span class="mobile-value">Brice Swyre</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Job:</span>
              <span class="mobile-value">Tax Accountant</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Company:</span>
              <span class="mobile-value">Carroll Group</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Location:</span>
              <span class="mobile-value">China</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Last Login:</span>
              <span class="mobile-value">8/15/2020</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Favorite Color:</span>
              <span class="mobile-value">Red</span>
            </div>
          </td>
        </tr>
        
        <!-- Continue for remaining rows with the same pattern... -->
        <!-- I'll show a few more and you can replicate for the rest -->
        
        <!-- Row 4 -->
        <tr class="group">
          <th>4</th>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Name:</span>
              <span class="mobile-value">Marjy Ferencz</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Job:</span>
              <span class="mobile-value">Office Assistant I</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Company:</span>
              <span class="mobile-value">Rowe-Schoen</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Location:</span>
              <span class="mobile-value">Russia</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Last Login:</span>
              <span class="mobile-value">3/25/2021</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Favorite Color:</span>
              <span class="mobile-value">Crimson</span>
            </div>
          </td>
        </tr>
        
        <!-- Row 5 -->
        <tr class="group">
          <th>5</th>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Name:</span>
              <span class="mobile-value">Yancy Tear</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Job:</span>
              <span class="mobile-value">Community Outreach Specialist</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Company:</span>
              <span class="mobile-value">Wyman-Ledner</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Location:</span>
              <span class="mobile-value">Brazil</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Last Login:</span>
              <span class="mobile-value">5/22/2020</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Favorite Color:</span>
              <span class="mobile-value">Indigo</span>
            </div>
          </td>
        </tr>
        
        <!-- Add rows 6-20 following the same pattern -->
        <!-- ... -->
        
        <!-- Last row (20) as example -->
        <tr class="group">
          <th>20</th>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Name:</span>
              <span class="mobile-value">Lorelei Blackstone</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Job:</span>
              <span class="mobile-value">Data Coordiator</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Company:</span>
              <span class="mobile-value">Witting, Kutch and Greenfelder</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Location:</span>
              <span class="mobile-value">Kazakhstan</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Last Login:</span>
              <span class="mobile-value">6/3/2020</span>
            </div>
          </td>
          <td class="md:table-cell">
            <div class="mobile-row">
              <span class="mobile-label md:hidden">Favorite Color:</span>
              <span class="mobile-value">Red</span>
            </div>
          </td>
        </tr>
      </tbody> --}}
      {{-- <tfoot class="hidden md:table-footer-group">
        <tr>
          <th></th>
          <th>Name</th>
          <th>Job</th>
          <th>Company</th>
          <th>Location</th>
          <th>Last Login</th>
          <th>Favorite Color</th>
        </tr>
      </tfoot> --}}
    </table>
  </div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="px-6 py-3">
          Product name
        </th>
        <th scope="col" class="px-6 py-3">
          Customer Name
        </th>
        <th scope="col" class="px-6 py-3">
          Order Ref
        </th>
        <th scope="col" class="px-6 py-3">
          Cost
        </th>
        <th scope="col" class="px-6 py-3">
          Qty
        </th>
        <th scope="col" class="px-6 py-3">
          Total
        </th>
      </tr>
    </thead>
    <tbody>

      @forelse ($orders as $order)
        <tr class="{{ $loop->index % 2 == 0 ? 'bg-white border-b dark:bg-gray-900 dark:border-gray-700' : 'border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700' }} ">
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $order->products[0]->name }}
          </th>
          <td class="px-6 py-4">
            {{ $order->customer_name }}
          </td>
          <td class="px-6 py-4">
            {{ $order->order_ref }}
          </td>
          <td class="px-6 py-4">
            {{ $order->products[0]->cost / 100 }} $USD
          </td>
          <td class="px-6 py-4">
            {{ $order->products[0]->pivot->qty }}
          </td>
          <td class="px-6 py-4">
            <p class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
              {{ ($order->products[0]->cost * $order->products[0]->pivot->qty) / 100 }} $USD
            </p>
          </td>
        </tr>
      @empty
        <p>No Orders</p>
      @endforelse

    </tbody>
  </table>
</div>

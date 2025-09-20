<div class="p-5 border rounded-md md:p-8 border-slate-200 dark:border-zink-500 print:p-0">
    <div
        class="grid grid-cols-1 text-center divide-y md:divide-y-0 md:divide-x rtl:divide-x-reverse divide-dashed md:grid-cols-4 divide-slate-200 dark:divide-zink-500">
        <div class="p-3">
            <h6 class="mb-1">#{{ $data->invoice_id }}</h6>
            <p class="text-slate-500 dark:text-zink-200">No. Invoice</p>
        </div><!--end col-->
        <div class="p-3">
            <h6 class="mb-1">{{ \Carbon\Carbon::parse($data->created_at)->format('d M, Y') }}</h6>
            <p class="text-slate-500 dark:text-zink-200">Tanggal Transaksi</p>
        </div><!--end col-->
        <div class="p-3">
            <h6 class="mb-1"><span
                    class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent">Terbayar</span>
            </h6>
            <p class="text-slate-500 dark:text-zink-200">Status Pembayaran</p>
        </div><!--end col-->
        <div class="p-3">
            <h6 class="mb-1">{{ rupiah($data->total) }}</h6>
            <p class="text-slate-500 dark:text-zink-200">Jumlah Transaksi</p>
        </div><!--end col-->
    </div><!--end grid-->

    <div class="grid grid-cols-1 gap-5 mt-8 md:grid-cols-2">
        <div>
            <p class="mb-2 text-sm uppercase text-slate-500 dark:text-zink-200">Petugas</p>
            <h6 class="mb-1 text-15">{{ $data->staff->name }}</h6>
            <p class="mb-1 text-slate-500 dark:text-zink-200">{{ $data->uptd->name }}</p>
            <p class="mb-1 text-slate-500 dark:text-zink-200">{{ $data->uptd->address }}</p>
        </div><!--end col-->
        {{-- <div>
            <p class="mb-2 text-sm uppercase text-slate-500 dark:text-zink-200">Pembeli</p>
            <h6 class="mb-1 text-15">{{ $data->name }}</h6>
            <p class="mb-1 text-slate-500 dark:text-zink-200">176 Arvid Crest Sheastad, IA</p>
            <p class="mb-1 text-slate-500 dark:text-zink-200">+(211) 0123 456 897</p>
            <p class="mb-1 text-slate-500 dark:text-zink-200">TAX No. 5415421</p>
        </div><!--end col--> --}}
    </div><!--end grid-->

    <div class="mt-6 overflow-x-auto">
        <table class="w-full whitespace-nowrap">
            <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th
                        class="px-3.5 py-2.5 font-semibold text-slate-500 border-b border-slate-200 dark:text-zink-200 dark:border-zink-500">
                        #</th>
                    <th
                        class="px-3.5 py-2.5 font-semibold text-slate-500 border-b border-slate-200 dark:text-zink-200 dark:border-zink-500">
                        Ikan</th>
                    <th
                        class="px-3.5 py-2.5 font-semibold text-slate-500 border-b border-slate-200 dark:text-zink-200 dark:border-zink-500">
                        Satuan</th>
                    <th
                        class="px-3.5 py-2.5 font-semibold text-slate-500 border-b border-slate-200 dark:text-zink-200 dark:border-zink-500">
                        Ukuran</th>
                    <th
                        class="px-3.5 py-2.5 font-semibold text-slate-500 border-b border-slate-200 dark:text-zink-200 dark:border-zink-500">
                        Jumlah</th>
                    <th
                        class="px-3.5 py-2.5 font-semibold text-slate-500 border-b border-slate-200 dark:text-zink-200 dark:border-zink-500">
                        Harga</th>
                    <th
                        class="px-3.5 py-2.5 font-semibold text-slate-500 border-b border-slate-200 dark:text-zink-200 dark:border-zink-500">
                        Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->details as $detail)
                    <tr>
                        <td class="px-3.5 py-2.5 border-b border-slate-200 dark:border-zink-500">{{ $loop->iteration }}
                        </td>
                        <td class="px-3.5 py-2.5 border-b border-slate-200 dark:border-zink-500">
                            <h6 class="mb-1">{{ $detail->name }}</h6>
                            {{-- <p class="text-slate-500 dark:text-zink-200">{{ $detail->unit }}</p> --}}
                        </td>
                        <td class="px-3.5 py-2.5 border-b border-slate-200 dark:border-zink-500">{{ $detail->unit }}
                        </td>
                        <td class="px-3.5 py-2.5 border-b border-slate-200 dark:border-zink-500">
                            {{ str_replace('ukuran ', '', $detail->size) }}
                        </td>
                        <td class="px-3.5 py-2.5 border-b border-slate-200 dark:border-zink-500">
                            {{ $detail->quantity }}
                        </td>
                        <td class="px-3.5 py-2.5 border-b border-slate-200 dark:border-zink-500">{{ $detail->price }}
                        </td>
                        <td class="px-3.5 py-2.5 border-b border-slate-200 dark:border-zink-500">{{ $detail->total }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tbody class="before:block before:h-3">
                <tr>
                    <td colspan="5"></td>
                    <td
                        class="border-b border-slate-200 px-3.5 py-2.5 text-slate-500 dark:border-zink-500 dark:text-zink-200">
                        Sub Total
                    </td>
                    <td
                        class="border-b border-slate-200 px-3.5 py-2.5 text-slate-500 dark:border-zink-500 dark:text-zink-200">
                        {{ rupiah($data->total) }}
                    </td>
                </tr>
                {{-- <tr>
                    <td colspan="5"></td>
                    <td
                        class="border-b border-slate-200 px-3.5 py-2.5 text-slate-500 dark:border-zink-500 dark:text-zink-200">
                        Retribusi (18%)
                    </td>
                    <td
                        class="border-b border-slate-200 px-3.5 py-2.5 text-slate-500 dark:border-zink-500 dark:text-zink-200">
                        {{ rupiah($data->retribution) }}
                    </td>
                </tr> --}}
                <tr>
                    <td colspan="5"></td>
                    <td class="border-b border-slate-200 px-3.5 py-2.5 font-medium dark:border-zink-500">
                        Total Transaksi
                    </td>
                    <td class="border-b border-slate-200 px-3.5 py-2.5 font-medium dark:border-zink-500">
                        {{ rupiah($data->total) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="my-5">
        <p class="mb-2 text-sm uppercase text-slate-500 dark:text-zink-200">Rincian Pembayaran</p>
        <p class="mb-1 text-slate-500 dark:text-zink-200">Metode Pembayaran: Cash</p>
        {{-- <p class="mb-1 text-slate-500 dark:text-zink-200">Nama: {{ $data->name }}</p> --}}
        <p class="mb-0 text-slate-500 dark:text-zink-200">Total Transaksi: <b>{{ rupiah($data->total) }}</b></p>
    </div>

    {{-- <div
        class="flex gap-1 px-4 py-3 text-sm border rounded-md md:items-center border-sky-200 text-sky-500 bg-sky-50 dark:bg-sky-400/20 dark:border-sky-500/50">
        <p><span class="font-bold">CATATAN:</span> -</p>
    </div> --}}
</div>

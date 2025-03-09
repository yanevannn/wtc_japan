<div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-12 px-4">
    <div class="relative bg-white px-6 pt-10 pb-9 shadow-xl mx-auto w-full max-w-lg rounded-2xl">
      <div class="mx-auto flex w-full max-w-md flex-col space-y-16">
        <div class="flex flex-col items-center justify-center text-center space-y-2">
          <div class="font-semibold text-3xl">
            <p>Verifikasi Email</p>
          </div>
          <div class="flex flex-row text-sm font-medium text-gray-400">
            <p>Kami sudah mengirimkan kode verifikasi ke email ba**@dipainhouse.com</p>
          </div>
        </div>

        <div>
          <form action="" method="post">
            <div class="flex flex-col space-y-16">
              <div class="flex flex-row items-center justify-between mx-auto w-full max-w-xs">
                <div class="w-16 h-16">
                  <input class="input-field w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700" type="text" maxlength="1" pattern="\d*" required>
                </div>
                <div class="w-16 h-16">
                  <input class="input-field w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700" type="text" maxlength="1" pattern="\d*" required>
                </div>
                <div class="w-16 h-16">
                  <input class="input-field w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700" type="text" maxlength="1" pattern="\d*" required>
                </div>
                <div class="w-16 h-16">
                  <input class="input-field w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700" type="text" maxlength="1" pattern="\d*" required>
                </div>
              </div>

              <div class="flex flex-col space-y-5">
                <div>
                  <button class="flex flex-row items-center justify-center text-center w-full border rounded-xl outline-none py-5 bg-blue-700 border-none text-white text-sm shadow-sm">
                    Verify Account
                  </button>
                </div>

                <div class="flex flex-row items-center justify-center text-center text-sm font-medium space-x-1 text-gray-500">
                  <p>Tidak mendapatkan kode?</p> <a class="flex flex-row items-center text-blue-600" href="#" target="_blank" rel="noopener noreferrer">Kirim Ulang</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const inputs = document.querySelectorAll('.input-field');

      inputs.forEach((input, index) => {
        input.addEventListener('input', (event) => {
          if (event.target.value.length === 1 && index < inputs.length - 1) {
            inputs[index + 1].focus();
          }
        });

        input.addEventListener('keydown', (event) => {
          if (event.key === 'Backspace' && event.target.value.length === 0 && index > 0) {
            inputs[index - 1].focus();
          }
        });

        input.addEventListener('paste', (event) => {
          event.preventDefault();
          const paste = (event.clipboardData || window.clipboardData).getData('text');
          const pasteArray = paste.split('');
          pasteArray.forEach((char, i) => {
            if (inputs[index + i]) {
              inputs[index + i].value = char;
            }
          });
          if (pasteArray.length === inputs.length) {
            inputs[inputs.length - 1].focus();
          } else if (inputs[index + pasteArray.length]) {
            inputs[index + pasteArray.length].focus();
          }
        });
      });
    });
  </script>
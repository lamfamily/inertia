<template>
  <div class="bg-[#252525] text-[#fffef2] text-[.9375rem]" id="footer-info1">
    <div class="grid gap-x-10 gap-y-12 grid-cols-5 [grid-template-rows:auto_1fr] px-10 py-[50px] border-b-3 border-[#d6d5cb]">
      <!-- grid 1 -->
      <div class="col-start-1 col-end-3">
        <div>訂閱 Aesop 電子報</div>

        <!-- 分割線 -->
        <div class="my-5 border-b-1"></div>

        <!-- 電子郵件 -->
        <div class="relative flex items-center border rounded">
          <div class="flex-1">
            <label class="">
              <input
                type="text"
                class="h-[37px] pl-[10px] w-full focus:outline-none"
                @focus="is_input_focused = true"
                @blur="is_input_focused = false"
              />
              <div
                class="absolute top-[2px] left-[10px] text-[20px] font-light z-10"
                v-show="!is_input_focused"
              >
                電郵地址
              </div>
            </label>
          </div>
          <div>
            <button class="cursor-pointer p-2">
              <svg
                aria-labelledby="rightArrow-:R15inqm:"
                data-testid="data-testid-Icon"
                focusable="false"
                height="12"
                role="img"
                style="height: 12px; width: 12px"
                tabindex="-1"
                viewBox="0 0 50 50"
                width="12"
                fill="currentColor"
              >
                <title id="rightArrow-:R15inqm:">rightArrow</title>
                <g>
                  <path
                    d="M30.1,5.3L50,25.1L30.1,45h-6.6l18-17.6H0v-4.8h41.5l-18-17.6h6.6V5.3z"
                  ></path>
                </g>
              </svg>
            </button>
          </div>
        </div>

        <!-- 電子郵件訂閱 -->
        <div class="flex items-center text-[.875rem] py-3">
          <label class="inline-flex items-center cursor-pointer">
            <input
              type="checkbox"
              class="peer appearance-none h-4 w-4 border-1 border-[#fffef2] bg-[#252525] transition-colors"
            />
            <svg
              class="hidden peer-checked:block absolute w-4 h-4 text-white pointer-events-none"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="3"
                d="M5 13l4 4L19 7"
              />
            </svg>
            <span class="ml-2"
              >訂閱我們的通訊，接收有關 Aesop 產品及服務的更多資訊。訂閱即確認您已閱讀並理解我們的
              <a class="underline" href="">私隱政策</a>
              。
            </span>
          </label>
        </div>
      </div>
      <!-- grid 2 -->
      <div>
        <div>訂單與協助</div>

        <!-- 分割線 -->
        <div class="my-5 border-b-1"></div>

        <div class="flex flex-col gap-3 text-[.875rem]">
          <a href="">
            聯絡我們
            <svg
              class="inline-block"
              aria-labelledby="rightUpArrow-:Rkb7nqm:"
              data-testid="data-testid-Icon"
              focusable="false"
              height="12"
              role="img"
              style="height: 12px; width: 12px"
              tabindex="-1"
              viewBox="0 0 50 50"
              width="12"
              fill="currentColor"
            >
              <title id="rightUpArrow-:Rkb7nqm:">rightUpArrow</title>
              <g>
                <path
                  d="M21.8,0.2l28.1-0.1v28.1l-4.5,0l0.1-20.5L16.2,37.1l-3.4-3.4L42.1,4.4L21.8,4.4L21.8,0.2L21.8,0.2z"
                ></path>
              </g>
            </svg>
          </a>
          <a href="">
            常見問答
            <svg
              class="inline-block"
              aria-labelledby="rightUpArrow-:Rkb7nqm:"
              data-testid="data-testid-Icon"
              focusable="false"
              height="12"
              role="img"
              style="height: 12px; width: 12px"
              tabindex="-1"
              viewBox="0 0 50 50"
              width="12"
              fill="currentColor"
            >
              <title id="rightUpArrow-:Rkb7nqm:">rightUpArrow</title>
              <g>
                <path
                  d="M21.8,0.2l28.1-0.1v28.1l-4.5,0l0.1-20.5L16.2,37.1l-3.4-3.4L42.1,4.4L21.8,4.4L21.8,0.2L21.8,0.2z"
                ></path>
              </g>
            </svg>
          </a>
          <a href="">
            寄送
            <svg
              class="inline-block"
              aria-labelledby="rightUpArrow-:Rkb7nqm:"
              data-testid="data-testid-Icon"
              focusable="false"
              height="12"
              role="img"
              style="height: 12px; width: 12px"
              tabindex="-1"
              viewBox="0 0 50 50"
              width="12"
              fill="currentColor"
            >
              <title id="rightUpArrow-:Rkb7nqm:">rightUpArrow</title>
              <g>
                <path
                  d="M21.8,0.2l28.1-0.1v28.1l-4.5,0l0.1-20.5L16.2,37.1l-3.4-3.4L42.1,4.4L21.8,4.4L21.8,0.2L21.8,0.2z"
                ></path>
              </g>
            </svg>
          </a>
          <a href="">
            退貨
            <svg
              class="inline-block"
              aria-labelledby="rightUpArrow-:Rkb7nqm:"
              data-testid="data-testid-Icon"
              focusable="false"
              height="12"
              role="img"
              style="height: 12px; width: 12px"
              tabindex="-1"
              viewBox="0 0 50 50"
              width="12"
              fill="currentColor"
            >
              <title id="rightUpArrow-:Rkb7nqm:">rightUpArrow</title>
              <g>
                <path
                  d="M21.8,0.2l28.1-0.1v28.1l-4.5,0l0.1-20.5L16.2,37.1l-3.4-3.4L42.1,4.4L21.8,4.4L21.8,0.2L21.8,0.2z"
                ></path>
              </g>
            </svg>
          </a>
          <a href=""> 訂單歷史 </a>
          <a href=""> 禮品卡餘額 </a>
          <a href=""> 條款及細則 </a>
        </div>
      </div>
      <!-- grid 3 -->
      <div>
        <div>服務</div>

        <!-- 分割線 -->
        <div class="my-5 border-b-1"></div>

        <div class="flex flex-col gap-3 text-[.875rem]">
          <a href=""> 線上服務 </a>
          <a href=""> 企業禮品 </a>
          <a href=""> 面部護理服務 </a>
          <a href=""> 網購自取 </a>
          <a href=""> 線上視頻諮詢 </a>
        </div>
      </div>
      <!-- grid 4 -->
      <div>
        <div>地點偏好</div>

        <!-- 分割線 -->
        <div class="my-5 border-b-1"></div>

        <div class="flex flex-col gap-3 text-[.875rem]">
          <div>配送：</div>
          <a href="" class="underline"> 香港特別行政區 </a>
          <div>&nbsp;</div>
          <div>語言：</div>
          <a href="" class="underline"> 繁體中文 </a>
          <a href=""> English </a>
        </div>
      </div>
      <!-- grid 5 -->
      <div class="col-span-2">
        <div>環境永續性</div>

        <!-- 分割線 -->
        <div class="my-5 border-b-1"></div>

        <div class="text-[.875rem]">
          Aesop 的所有產品均為純素，且所有成分未進行動物測試實驗。我們是一間擁有跳躍小兔（Leaping Bunny）與 B 型共益企業（B Corporation）認證的公司。
          <a href="">了解更多</a>
        </div>
      </div>
      <!-- grid 6 -->
      <div>
        <div>
          關於
        </div>

        <!-- 分割線 -->
        <div class="my-5 border-b-1"></div>

        <div class="flex flex-col gap-3 text-[.875rem]">
          <a href=""> 關於Aesop </a>
          <a href=""> Aesop基金會 </a>
          <a href=""> 招聘 </a>
          <a href=""> 私隱政策 </a>
          <a href=""> 無障礙網站聲明 </a>
          <a href=""> Cookie 政策 </a>
        </div>

      </div>
      <!-- grid 7 -->
      <div>

        <div>
          社群媒體
        </div>

        <!-- 分割線 -->
        <div class="my-5 border-b-1"></div>

        <div class="flex flex-col gap-3 text-[.875rem]">
          <a href="">
            Instagram
            <svg
              class="inline-block"
              aria-labelledby="rightUpArrow-:Rkb7nqm:"
              data-testid="data-testid-Icon"
              focusable="false"
              height="12"
              role="img"
              style="height: 12px; width: 12px"
              tabindex="-1"
              viewBox="0 0 50 50"
              width="12"
              fill="currentColor"
            >
              <title id="rightUpArrow-:Rkb7nqm:">rightUpArrow</title>
              <g>
                <path
                  d="M21.8,0.2l28.1-0.1v28.1l-4.5,0l0.1-20.5L16.2,37.1l-3.4-3.4L42.1,4.4L21.8,4.4L21.8,0.2L21.8,0.2z"
                ></path>
              </g>
            </svg>
          </a>
          <a href="">
            Twitter
            <svg
              class="inline-block"
              aria-labelledby="rightUpArrow-:Rkb7nqm:"
              data-testid="data-testid-Icon"
              focusable="false"
              height="12"
              role="img"
              style="height: 12px; width: 12px"
              tabindex="-1"
              viewBox="0 0 50 50"
              width="12"
              fill="currentColor"
            >
              <title id="rightUpArrow-:Rkb7nqm:">rightUpArrow</title>
              <g>
                <path
                  d="M21.8,0.2l28.1-0.1v28.1l-4.5,0l0.1-20.5L16.2,37.1l-3.4-3.4L42.1,4.4L21.8,4.4L21.8,0.2L21.8,0.2z"
                ></path>
              </g>
            </svg>
          </a>
          <a href="">
            LinkedIn
            <svg
              class="inline-block"
              aria-labelledby="rightUpArrow-:Rkb7nqm:"
              data-testid="data-testid-Icon"
              focusable="false"
              height="12"
              role="img"
              style="height: 12px; width: 12px"
              tabindex="-1"
              viewBox="0 0 50 50"
              width="12"
              fill="currentColor"
            >
              <title id="rightUpArrow-:Rkb7nqm:">rightUpArrow</title>
              <g>
                <path
                  d="M21.8,0.2l28.1-0.1v28.1l-4.5,0l0.1-20.5L16.2,37.1l-3.4-3.4L42.1,4.4L21.8,4.4L21.8,0.2L21.8,0.2z"
                ></path>
              </g>
            </svg>
          </a>
        </div>

      </div>

    </div>

    <div class="px-10 flex items-center h-[72px]">
      @Aesop
    </div>
  </div>
</template>

<script setup lang="ts">
  import { ref } from 'vue';

  const is_input_focused = ref(false);
</script>

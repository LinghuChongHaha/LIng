<?php
/**
 * this file contains common functions
 * developers can add missing functions you think
 *
 */
class Util {



	/**
	 * RPC 接口调用
	 * param: url 请求地址
	 * param: arrMethodAndParams  请求参数，如：
	 * array(
	 *  'post' => array('key'=>$value),
	 *  'get'  => array('key'=>$value),
	 *   )
	 * param : arrFiel 上传文件信息，ex:
	 * array (
	 *    'key'  => 'file',
	 *    'path' => 'xxx.txt',
	 * )
	 * param : arrHeaders 请求头信息，ex:
	 *          array('Content-type:text/plain','Content-length:100')
	 * return: 请求返回结果
	 *
	 **/
	public static function curlReqeust($url, $arrMethodAndParams, $arrFile=false, $arrHeaders=false, $isRetry=true, $intConnectionTimeout=30, $intCurlTimeout=30) {
		// check arrmethodandparams
		$isParamOk = true;
		if (!empty($arrMethodAndParams) && !is_array($arrMethodAndParams) ){
			$isParamOk = false;
			$arrErrorMsg = array(
				'type' => 'maze.util.rpc',
				'content' => 'rpc params is illege',
			);

		} 

		if (empty($url)) {
			$isParamOk = false;
			$arrErrorMsg = array(
				'type' => 'maze.util.rpc',
				'content' => 'rpc url is empty',
			);
		}

		if (empty($isParamOk)) {

			return false;
		}


		//url get参数 格式整理
		if ($arrMethodAndParams['get']) {
			$strGetParams = '';
			foreach ($arrMethodAndParams['get'] as $key=>$val) {
				$strGetParams .= $key.'='.$val.'&';
			}

			$strGetParams = substr($strGetParams,0,-1);
			$url = $url.'?'.$strGetParams;
		}


		$curl = curl_init(); 

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $intConnectionTimeout);
		curl_setopt($curl, CURLOPT_TIMEOUT, $intCurlTimeout);
		if ($arrHeaders) {
			curl_setopt($curl, CURLOPT_HTTPHEADER, $arrHeaders);
		}           

		//post 
		if (!empty($arrMethodAndParams['post']) || !empty($arrFile['key']) ) {
			curl_setopt($curl,CURLOPT_POST, 1);
		}

		$uploadFile = array();
		if ($arrFile['key'] && $arrFile['path']) {
			$uploadKey  = $arrFile['key'];
			$uploadPath = $arrFile['path'];
			$uploadFile[$uploadKey] = new CURLFile($uploadPath); 
		}

		$arrPostData = !empty($arrMethodAndParams['post']) ? $arrMethodAndParams['post'] : array();
		$arrPostData = array_merge($arrPostData,$uploadFile);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $arrPostData);


		//exec
		$result = curl_exec($curl); 

		//retry
		if ($result === false && $isRetry) {
			$result = curl_exec($curl);
		}

		if ($result === false) {

			$errNo = curl_errno($curl);
			$errMsg = curl_error($curl);
			$arrMsg = array(
				'type' => 'maze.common.util.rpc',
				'content' => 'curl fialed,retry:2,url:'.$url.',error:'.$errno.',msg:'.$errMsg,
            );

            curl_close($curl);
            return false;
        }

        return $result;

    }


}

?>

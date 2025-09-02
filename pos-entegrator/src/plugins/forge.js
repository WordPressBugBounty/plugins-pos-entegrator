import forge from "node-forge";
const encrypt = (text) => {
  const key = document.getElementById("_gpos_nonce").value;
  const iv = forge.random.getBytesSync(16);
  const cipher = forge.cipher.createCipher(
    "AES-CBC",
    forge.util.hexToBytes(forge.md.sha256.create().update(key).digest().toHex())
  );
  cipher.start({ iv: iv });
  cipher.update(forge.util.createBuffer(text, "utf8"));
  cipher.finish();

  return { hex: cipher.output.toHex(), iv: forge.util.bytesToHex(iv) };
};
export default encrypt;

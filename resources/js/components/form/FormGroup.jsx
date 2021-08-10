import Label from './Label';

export default function FormGroup({ label, forInput = null, errors = null, children }) {
  return (
    <div className="mb-6">
      <Label forInput={forInput}>{label}</Label>

      <div className="block w-full mt-1">{children}</div>
    </div>
  );
}

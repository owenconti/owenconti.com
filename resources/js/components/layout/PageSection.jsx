export default function PageSection({ title, description = null, children }) {
  return (
    <div className="md:flex">
      <div className="md:w-64 lg:w-96 md:mr-16 lg:mr-24">
        <h2 className="text-lg font-medium">{title}</h2>
        {description ? <p className="mt-2 text-sm text-gray-500">{description}</p> : null}
      </div>

      <div className="mt-6 md:mt-0 md:flex-1">{children}</div>
    </div>
  );
}

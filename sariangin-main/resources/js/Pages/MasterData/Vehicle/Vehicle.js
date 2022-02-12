import React from "react";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-react";
import {
  Button,
  Card,
  Col,
  Image,
  Input,
  Modal,
  Popover,
  Row,
  Space,
  Table,
} from "antd";
import { Delete, EditSquare, InfoCircle } from "react-iconly";
import { routes } from "@/routes";
import { Breadcrumbs } from "@/Layouts/Components/Content/Breadcrumbs";
import { withTable } from "@/Pages/withTable";

const Vehicle = ({
  loading,
  dataSource,
  filters,
  pagination,
  handleSearch,
  handleChangeTable,
  getData,
}) => {
  const columns = [
    {
      title: "Kategori",
      dataIndex: "type",
      key: "type",
      filters: filters && filters["vehicleTypes"],
      sorter: true,
    },
    {
      title: "No Plat Polisi",
      dataIndex: "license_plate",
      key: "license_plate",
      sorter: true,
    },
    {
      title: "Foto",
      key: "photos",
      render: (text, record) => {
        if (!record.photos.length) {
          return "-";
        }
        return (
          <Image.PreviewGroup>
            {record.photos.map((photo) => (
              <Image height={100} src={photo.url} />
            ))}
          </Image.PreviewGroup>
        );
      },
    },
    {
      title: "Aksi",
      key: "actions",
      render: (text, record) => (
        <Space size="middle">
          <Popover content="Edit">
            <Link href={route(routes.VEHICLES_EDIT, record.id)}>
              <Button
                type="default"
                icon={
                  <EditSquare
                    size="medium"
                    set="curved"
                    className="remix-icon"
                  />
                }
              />
            </Link>
          </Popover>
          <Popover content="Delete">
            <Button
              type="primary"
              ghost
              danger
              icon={
                <Delete size="medium" set="curved" className="remix-icon" />
              }
              onClick={handleClickDelete(record.id)}
            />
          </Popover>
        </Space>
      ),
    },
  ];

  const handleClickDelete = (id) => () => {
    const data = dataSource.find((data) => data.id === id);

    Modal.confirm({
      title:
        'Hapus kendaraan "' + data.type + " (" + data.license_plate + ')"?',
      icon: <InfoCircle className="remix-icon" />,
      content: "Data kendaraan ini akan dihapus secara permanen.",
      onOk: () =>
        Inertia.delete(route(routes.VEHICLES_DESTROY, id), {
          onSuccess: () => {
            getData();
          },
        }),
    });
  };

  return (
    <React.Fragment>
      <Row gutter={[0, 32]}>
        <Breadcrumbs breadcrumbs={[{ name: "Data Kendaraan" }]} />
        <Col span={24}>
          <Card className="da-border-color-black-40">
            <Row gutter={[0, 32]}>
              <Col span={24}>
                <h4>Data Kendaraan</h4>
                {/* <p className="da-p1-body">Master Data</p> */}
              </Col>

              <Row justify="space-between" className="da-w-100">
                <Col>
                  <Input placeholder="Search ..." onChange={handleSearch} />
                </Col>
                <Col>
                  <Button type="primary">
                    <Link href={route(routes.VEHICLES_CREATE)}>Create</Link>
                  </Button>
                </Col>
              </Row>

              <Col span={24}>
                <Table
                  rowKey="id"
                  columns={columns}
                  dataSource={dataSource}
                  pagination={pagination}
                  loading={loading}
                  onChange={handleChangeTable}
                />
              </Col>
            </Row>
          </Card>
        </Col>
      </Row>
    </React.Fragment>
  );
};

export default withTable(Vehicle, {
  routeAjaxIndex: routes.VEHICLES_AJAX_INDEX,
});
